<?php
    // require_once 'conn.php';
    // echo $_POST["challengeName"];

    // echo $_POST["challengeImage"];

    define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
    define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");

    define("__MAX_FILE_SIZE__", 5000000);

    $target_file = __UPLOADS_DIR__ . basename($_FILES["fileToUpload"]["name"]);

    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if($check == false) {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > __MAX_FILE_SIZE__) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    $imageFileExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    echo "EXT: " . $imageFileExt . "\n";

    // Allow certain file formats
    if($imageFileExt != "jpg" && $imageFileExt != "png" && $imageFileExt != "jpeg") {
      echo "Sorry, only JPG, JPEG, PNG files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo $target_file;
      echo "\nSorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        echo __ROOT__;
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

?>
