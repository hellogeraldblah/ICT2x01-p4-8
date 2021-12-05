<?php

  require_once "../logic/userManagement.php";
  require_once "../databases/database.php";

  $conn = connect();
  $user_registration = new UserManagement($conn);

  if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");


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
