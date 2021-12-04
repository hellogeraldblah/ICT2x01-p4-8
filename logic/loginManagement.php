<?php

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");

require_once "../databases/database.php";
require_once "../logic/classes/login.php";

class LoginManagement {
  // Challenge_List entity, stores array of Challenge objects
  private $logins = array();
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
    $res = $this->conn->query("SELECT * FROM users");

//    while ($row = $res->fetchArray()) {
//      array_push($this->logins, new Logins($row['id'], $row['name'], $row['email'], $row['password']));
//    }
  }

  public function validate_email($login_email) {
    $error_message = "";

    if (empty($login_email)) {
      $error_message .= "Email cannot be empty. \\n";
    }

    return $error_message;

  }

  public function validate_password($login_password) {
    $error_message = "";

    if (empty($login_password)) {
      $error_message .= "Password cannot be empty. \\n";
    }

    return $error_message;

  }

  public function validate_login($login_email, $login_password) {
    // Validates the login data
    $error_message = "";
    $error_message .= $this->validate_email($login_email);
    $error_message .= $this->validate_password($login_password);

    return $error_message;
  }

  public function create_login($login_email, $login_password) {

    $sql_stmt = "SELECT COUNT(*) FROM users WHERE email = :email AND password = :password";

    $prepared_stmt = $this->conn->prepare($sql_stmt);
    $prepared_stmt->bindParam(":email", $login_email);
    $prepared_stmt->bindParam(":password", $login_password);
    
    if ($sql_stmt) {
        header("Location: ../presentation/dashboard.php");
    }
        
  }

}

$conn = connect();
$login_list_obj = new LoginManagement($conn);

?>
