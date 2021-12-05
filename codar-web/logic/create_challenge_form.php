<?php

    require_once "../constants.php";

    require_once __LOGIC_DIR__ . "utility.php";
    require_once __LOGIC_DIR__ . "challengeManagement.php";
    require_once __LOGIC_DIR__ . "achievementManagement.php";

    $challenge_name = filter_var($_POST["challengeName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $challenge_moves = $_POST["number_of_moves"];
    $challenge_file_info = $_FILES["fileToUpload"];

    $error_message = $challenge_management_obj->validate_challenge($challenge_name, $challenge_moves, $challenge_file_info);

    if (empty($error_message)) {

      $filename = $challenge_management_obj->generate_filename($conn);
      $challenge_management_obj->create_challenge($conn, $challenge_name, $challenge_moves, $challenge_file_info);

      upload_file($challenge_file_info, $filename);
      //create achievement
      $achievementManagement_obj->createAchievement($rowId);
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.history.back();</script>";
    }


?>
