<?php

require_once "../constants.php";

function upload_file($challenge_file_info, $challenge_filename) {
  // Generate absolute filename
  $target_file = __MAP_UPLOADS_DIR__ . $challenge_filename;

  if (move_uploaded_file($challenge_file_info["tmp_name"], $target_file)){
    return true;
  } else {
    return false;
  }

}


?>
