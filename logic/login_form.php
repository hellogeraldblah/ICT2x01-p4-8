<?php

    require_once "../logic/loginManagement.php";

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");


    $login_email = $_POST["loginEmail"];
    $login_password = $_POST["loginPassword"];

    $error_message = $login_list_obj->validate_login($login_email, $login_password);

    if (empty($error_message)) {
      $login_list_obj->create_login($login_email, $login_password);
    }

?>
