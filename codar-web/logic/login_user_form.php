<?php

  require_once "../constants.php";
  require_once __LOGIC_DIR__ . "userManagement.php";
  require_once __DATABASE_DIR__ . "database.php";

  $conn = connect();
  $user_login = new UserManagement();

  $username = $_POST["username"];
  $password = $_POST["password"];

  $user_id = $user_login->verify_user($conn, $username, $password);

  if ($user_id != false) {
    session_start();
    $user_info = $user_login->get_user($conn, $user_id);
    $_SESSION["user_id"] = $user_info->get_id();
    $_SESSION["user_name"] = $user_info->get_name();
    $_SESSION["user_username"] = $user_info->get_username();
    header("Location: ../presentation/dashboard.php");
  } else {
    echo "<script>alert('Invalid credentials!')</script>";
    echo "<script>window.history.back();</script>";
  }

?>
