<?php
  require_once "../constants.php";
  require_once __LOGIC_DIR__ . "userManagement.php";
  require_once __DATABASE_DIR__ . "database.php";

  $conn = connect();
  $user_registration = new UserManagement($conn);

  $signup_name = $_POST["signup_name"];
  $signup_username = $_POST["signup_username"];
  $signup_password = $_POST["signup_password"];

  $error_message = $user_registration->validate_signup($signup_name, $signup_username, $signup_password);

  if (empty($error_message)) {
    $user_registration->create_user($signup_name, $signup_username, $signup_password);
    header("Location: ../index.php");
  } else {
    echo "<script>alert('" . $error_message . "')</script>";
    echo "<script>window.history.back();</script>";
  }

?>
