<?php

    require_once "../constants.php";
    require_once __LOGIC_DIR__ . "utility.php";
    require_once __LOGIC_DIR__ . "challengeManagement.php";


    $edit_name = false;
    $edit_moves = false;
    $edit_file = false;

    $error_message = "";

    $new_challenge_name =  $_POST["challengeName"];
    $new_challenge_moves = $_POST["number_of_moves"];
    $new_challenge_file = $_FILES["fileToUpload"];

    $challenge = $challenge_management_obj->search_challenge($conn, $_POST["challenge_id"]);

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
        $challenge_management_obj->edit_challenge_name($conn, $challenge->get_id(), $new_challenge_name);
      }

      if ($edit_moves) {
        $challenge_management_obj->edit_challenge_moves($conn, $challenge->get_id(), $new_challenge_moves);
      }

      if ($edit_file) {
        $filename = $challenge->get_filepath();
        upload_file($new_challenge_file, $filename);
      }
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      // header("Location ../presentation/edit_challenge.php");
      echo "<script>window.history.back();</script>";
    }

?>
