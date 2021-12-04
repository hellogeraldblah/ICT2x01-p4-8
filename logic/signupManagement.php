<?php

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");

require_once "../databases/database.php";
require_once "../logic/classes/signup.php";

class SignupManagement {
  // Challenge_List entity, stores array of Challenge objects
  private $signups = array();
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
    $res = $this->conn->query("SELECT * FROM users");

    while ($row = $res->fetchArray()) {
      array_push($this->signups, new Signup($row['id'], $row['name'], $row['email'], $row['password']));
    }
  }

  private function get_last_id() {
    $number_of_rows = $this->conn->querySingle("SELECT COUNT(*) as COUNT FROM users");
    return $number_of_rows;
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

  public function validate_email($signup_email) {
    $error_message = "";

    if (empty($signup_email)) {
      $error_message .= "Email cannot be empty. \\n";
    }


      if (strlen($signup_email ) > 100) {
        $error_message .= "Email must be within 100 characters. \\n";
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

  public function validate_signup($signup_name, $signup_email, $signup_password) {
    // Validates the new signup data
    $error_message = "";
    $error_message .= $this->validate_name($signup_name);
    $error_message .= $this->validate_email($signup_email);
    $error_message .= $this->validate_password($signup_password);

    return $error_message;
  }

  public function create_signup($signup_name, $signup_email, $signup_password) {

    $sql_stmt = "INSERT INTO users(name, email, password)" . "VALUES(:name, :email, :password)";

    $prepared_stmt = $this->conn->prepare($sql_stmt);
    $prepared_stmt->bindParam(":name", $signup_name);
    $prepared_stmt->bindParam(":email", $signup_email);
    $prepared_stmt->bindParam(":password", $signup_password);
    $prepared_stmt->execute();

    return $this->conn->lastInsertRowID();
  }

}

$conn = connect();
$signup_list_obj = new SignupManagement($conn);

?>
