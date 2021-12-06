<?php

require_once "constants.php";

// get database connection
function connect($db_filepath=""){

  if (empty($db_filepath)) {
      $db_filepath = __CODAR_DATABASE_FILE__;
  }

  if (!file_exists($db_filepath)) {
    echo "Cannot find database file!" . $db_filepath;
    return false;
  }

  $db = new SQLite3($db_filepath);

  return $db;

}

?>
