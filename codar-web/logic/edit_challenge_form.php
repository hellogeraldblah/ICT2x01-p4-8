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
    $new_challenge_file = $_FILES["fileToUpload"];

    $challenge = $challenge_management_obj->search_challenge($_POST["challenge_id"]);

    if ($challenge->get_name() != $new_challenge_name) {
      $error_message .= $challenge_management_obj->validate_name($new_challenge_name);
      $edit_name = true;
    }

    if ($challenge->get_number_of_moves() != $new_challenge_moves) {
      $error_message .= $challenge_management_obj->validate_moves($new_challenge_moves);
      $edit_moves = true;
    }

    if ($new_challenge_file["error"] == 0 ) {
      $error_message .= $challenge_management_obj->validate_file($new_challenge_file);
      $edit_file = true;
    }

    if (empty($error_message)) {
      if ($edit_name) {
        $challenge_management_obj->edit_challenge_name($challenge->get_id(), $new_challenge_name);
      }

      if ($edit_moves) {
        $challenge_management_obj->edit_challenge_moves($challenge->get_id(), $new_challenge_moves);
      }

      if ($edit_file) {
        $filename = $challenge->get_filepath();
        upload_file($new_challenge_file, $filename);
      }
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.history.back();</script>";
    }

?>
