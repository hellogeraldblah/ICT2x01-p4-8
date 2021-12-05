<?php

require_once "../constants.php";
require_once __CLASSES_DIR__ . "user.php";

class UserManagement {
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
  }

  public function validate_name($signup_name) {
    $error_message = "";

    if (empty($signup_name)) {
      $error_message .= "Name cannot be empty. \\n";
    }

    if (preg_match('/[\'^£$%&*()@#~?<>,|=_+¬-]/', $signup_name)){
      $error_message .= "Name cannot contain special characters. \\n";
    }

    if (strlen($signup_name) > 100) {
      $error_message .= "Name must be within 100 characters. \\n";
    }

    return $error_message;

  }

  public function validate_username($signup_username) {
    $error_message = "";

    if (empty($signup_username)) {
      $error_message .= "Username cannot be empty. \\n";
    }

    if (preg_match('/[\'^£$%&*()@#~?<>,|=_+¬-]/', $signup_username)){
      $error_message .= "Username cannot contain special characters. \\n";
    }

    if (strlen($signup_username) > 100) {
      $error_message .= "Username must be within 100 characters. \\n";
    }


    return $error_message;

  }

  public function validate_password($signup_password) {
    $error_message = "";

    if (empty($signup_password)) {
      $error_message .= "Password cannot be empty. \\n";
    }

    if (strlen($signup_password ) < 8) {
      $error_message .= "Password must be at least 8 characters. \\n";
    }

    return $error_message;

  }

  public function validate_signup($signup_name, $signup_username, $signup_password) {
    // Validates the new signup data
    $error_message = "";

    $error_message .= $this->validate_name($signup_name);
    $error_message .= $this->validate_username($signup_username);
    $error_message .= $this->validate_password($signup_password);

    return $error_message;
  }

  public function create_user($signup_name, $signup_username, $signup_password) {

    $sql_stmt = "INSERT INTO users(name, username, password)" . "VALUES(:name, :username, :password)";

    $hashed_password = password_hash($signup_password, PASSWORD_DEFAULT);

    $prepared_stmt = $this->conn->prepare($sql_stmt);
    $prepared_stmt->bindParam(":name", $signup_name);
    $prepared_stmt->bindParam(":username", $signup_username);
    $prepared_stmt->bindParam(":password", $hashed_password);
    $prepared_stmt->execute();

    return $this->conn->lastInsertRowID();
  }

  public function verify_user($username, $password) {
    $res = $this->conn->query("SELECT * FROM users");

    while ($row = $res->fetchArray()) {
      if ($row["username"] == $username) {
        if (password_verify($password, $row["password"])){
          return $row["id"];
        }
      }
    }

    return false;
  }

  public function get_user($user_id){
    $res = $this->conn->query("SELECT * FROM users");

    while ($row = $res->fetchArray()) {
      if ($row["id"] == $user_id) {
        return new User($row["id"], $row["name"], $row["username"]);
      }
    }

    return false;
  }

}

?>
