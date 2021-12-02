<?php

    require_once "../logic/challengeManagement.php";
    require_once "../logic/achievementManagement.php";

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
if(!defined("__UPLOADS_DIR__")) define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
if(!defined("__MAX_FILE_SIZE__")) define("__MAX_FILE_SIZE__", 5000000); # Maximum challenge file size: 5mb

    $challenge_name = filter_var($_POST["challengeName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $challenge_moves = $_POST["number_of_moves"];
    $challenge_file_info = $_FILES;

    $error_message = $challenge_list_obj->validate_challenge($challenge_name, $challenge_moves, $challenge_file_info);

    if (empty($error_message)) {
       $rowId = $challenge_list_obj->create_challenge($challenge_name, $challenge_moves, $challenge_file_info);
       //create achievement
        $achievementManagement_obj->createAchievement($rowId);
       header("Location: ../presentation/challenges.php");
//      echo "pp";
    } else {
      echo "<script>window.alert('" . $error_message . "');
            window.location ='../presentation/create_challenge.php';
            </script>";
      // echo "<script>window.history.back();</script>";
    }


?>
