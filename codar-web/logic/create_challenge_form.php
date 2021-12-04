<?php

    require_once "../logic/challengeManagement.php";

    define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
    define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
    define("__MAX_FILE_SIZE__", 5000000);

    $challenge_name = filter_var($_POST["challengeName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $challenge_moves = $_POST["number_of_moves"];
    $challenge_file_info = $_FILES["fileToUpload"];

    $error_message = $challenge_management_obj->validate_challenge($challenge_name, $challenge_moves, $challenge_file_info);

    if (empty($error_message)) {
      $filename = $challenge_management_obj->generate_filename();
      $challenge_management_obj->create_challenge($challenge_name, $challenge_moves, $challenge_file_info);
      upload_file($challenge_file_info, $filename);
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.history.back();</script>";
    }


?>
