<?php

    require_once "../logic/challengeManagement.php";

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
if(!defined("__UPLOADS_DIR__")) define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
if(!defined("__MAX_FILE_SIZE__")) define("__MAX_FILE_SIZE__", 5000000); # Maximum challenge file size: 5mb

    $edit_name = false;
    $edit_moves = false;
    $edit_file = false;

    $error_message = "";

    $new_challenge_name =  $_POST["challengeName"];
    $new_challenge_moves = $_POST["number_of_moves"];
    $new_challenge_file = __UPLOADS_DIR__ . $_FILES["fileToUpload"]["name"];

    $challenge = $challenge_list_obj->search_challenge($_POST["challenge_id"]);

    if ($challenge->name != $new_challenge_name) {
      $error_message .= $challenge_list_obj->validate_name($new_challenge_name);
      $edit_name = true;
    }

    if ($challenge->moves != $new_challenge_moves) {
      $error_message .= $challenge_list_obj->validate_moves($new_challenge_moves);
      $edit_moves = true;
    }

    if (__UPLOADS_DIR__ != $new_challenge_file) {
      // echo "<script>alert('" . $new_challenge_file . "')</script>";
      $error_message .= $challenge_list_obj->validate_file($new_challenge_file);
      $edit_file = true;
    }

    if (empty($error_message)) {
      if ($edit_name) {
        $challenge_list_obj->edit_challenge_name($challenge->id, $new_challenge_name);
      }

      if ($edit_moves) {
        $challenge_list_obj->edit_challenge_moves($challenge->id, $new_challenge_moves);
      }

      if ($edit_file) {
        $challenge_list_obj->edit_challenge_file($challenge->id, $new_challenge_file);
      }
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.history.back();</script>";
    }

?>
