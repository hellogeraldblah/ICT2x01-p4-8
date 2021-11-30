<?php

    require_once "../logic/challengeManagement.php";

    define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
    define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
    define("__MAX_FILE_SIZE__", 5000000);

    $challenge_name = filter_var($_POST["challengeName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $challenge_moves = $_POST["number_of_moves"];
    $challenge_file = __UPLOADS_DIR__ . basename($_FILES["fileToUpload"]["name"]);
    
    $error_message = $challenge_list_obj->validate_challenge($challenge_name, $challenge_moves, $challenge_file);

    if (empty($error_message)) {
      $challenge_list_obj->create_challenge($challenge_name, $challenge_moves, $challenge_file);
      header("Location: ../presentation/challenges.php");
    } else {
      echo "<script>alert('" . $error_message . "')</script>";
      echo "<script>window.history.back();</script>";
    }


?>
