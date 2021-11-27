<?php

    define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
    define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");

    define("__MAX_FILE_SIZE__", 5000000);

    $target_file = __UPLOADS_DIR__ . basename($_FILES["fileToUpload"]["name"]);

    $error_message = "";

    // 1 will indicate OK for upload, 0 otherwise
    $upload_flag = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check == false) {
      $error_message .= "File is not an image.";
      $upload_flag = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > __MAX_FILE_SIZE__) {
      $error_message .= "Sorry, your file is too large.";
      $upload_flag = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      // $error_message .= "Sorry, file already exists.";
      $upload_flag = 0;
    }

    // Allow only jpg, png and jpeg file formats
    $imageFileExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileExt != "jpg" && $imageFileExt != "png" && $imageFileExt != "jpeg") {
      $error_message .= "Sorry, only JPG, JPEG, PNG files are allowed.";
      $upload_flag = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($upload_flag == 1) {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        header("Location: ../challenges.php");
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
      echo $error_message;
      // redirect back to create _chhalenge
    }

?>

<script>
  //
  // alert("error");
  // window.location.replace("../create_challenge.php");


</script>
