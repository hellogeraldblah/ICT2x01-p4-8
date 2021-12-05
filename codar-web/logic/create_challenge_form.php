<?php
    require_once "../logic/utility.php";
    require_once "../logic/challengeManagement.php";
    require_once "../logic/achievementManagement.php";

  if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
  if(!defined("__UPLOADS_DIR__")) define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
  if(!defined("__MAX_FILE_SIZE__")) define("__MAX_FILE_SIZE__", 5000000); # Maximum challenge file size: 5mb

    $challenge_name = filter_var($_POST["challengeName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $challenge_moves = $_POST["number_of_moves"];
    $challenge_file_info = $_FILES["fileToUpload"];

    $error_message = $challenge_management_obj->validate_challenge($challenge_name, $challenge_moves, $challenge_file_info);

    if (empty($error_message)) {

      $filename = $challenge_management_obj->generate_filename();
      $rowId = $challenge_management_obj->create_challenge($challenge_name, $challenge_moves, $challenge_file_info);
      upload_file($challenge_file_info, $filename);
      //create achievement
      $achievementManagement_obj->createAchievement($rowId);
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.history.back();</script>";
    }


?>
