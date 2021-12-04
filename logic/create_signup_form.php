<?php

    require_once "../logic/signupManagement.php";

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");


    $signup_name = $_POST["signupName"];
    $signup_email = $_POST["signupEmail"];
    $signup_password = $_POST["signupPassword"];

    $error_message = $signup_list_obj->validate_signup($signup_name, $signup_email, $signup_password);

    if (empty($error_message)) {
      $signup_list_obj->create_signup($signup_name, $signup_email, $signup_password);
    }

?>
