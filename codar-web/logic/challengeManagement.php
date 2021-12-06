<?php

require_once "../constants.php";

if(!defined("__MAX_CHALLENGE_MOVES__")) define("__MAX_CHALLENGE_MOVES__", 100); # Maximum moves a challenge can have
if(!defined("__MAX_FILE_SIZE__")) define("__MAX_FILE_SIZE__", 5000000); # Maximum challenge file size: 5mb

require_once __DATABASE_DIR__ . "database.php";
require_once __CLASSES_DIR__ . "challenge.php";

class ChallengeManagement {

  public function get_last_id($conn) {
    $number_of_rows = $conn->querySingle("SELECT COUNT(*) as COUNT FROM challenges");
    return $number_of_rows;
  }

  public function validate_name($challenge_name) {
    $error_message = "";

    $challenge_name = trim($challenge_name);

    if (empty($challenge_name)) {
      $error_message .= "Challenge Name cannot be empty. \\n";
    }

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $challenge_name)){
      $error_message .= "Challenge Name cannot contain special characters. \\n";
    }

    if (strlen($challenge_name ) > 100) {
      $error_message .= "Challenge Name must be within 100 characters. \\n";
    }

    return $error_message;

  }

  public function validate_moves($challenge_moves) {
    $error_message = "";

    if (filter_var($challenge_moves, FILTER_VALIDATE_INT) == false) {
      $error_message .= "Challenge Moves must be an integer. \\n";
      return $error_message;
    }

    if ($challenge_moves > __MAX_CHALLENGE_MOVES__) {
      $error_message .= "Challenge Moves cannot be more than " . __MAX_CHALLENGE_MOVES__ . ". \\n";
    }

    return $error_message;

  }

  public function validate_file($challenge_file_info) {
    $error_message = "";

    // Check file size
    if ($challenge_file_info["size"] > __MAX_FILE_SIZE__) {
      $error_message .= "Challenge File is too large. \\n";
    }

    if ($challenge_file_info["size"] != 0) {
      // Check if image file is a actual image or fake image
      $check = getimagesize($challenge_file_info["tmp_name"]);
      if($check == false) {
        $error_message .= "Challenge File is not an image. \\n";
      }
    }


    // Allow only jpg, png and jpeg file formats
    $imageFileExt = strtolower(pathinfo($challenge_file_info["name"], PATHINFO_EXTENSION));
    if($imageFileExt != "jpg" && $imageFileExt != "png" && $imageFileExt != "jpeg") {
      $error_message .= "Challenge File only accepts JPG, JPEG, PNG extensions. \\n";
    }

    return $error_message;
  }

  public function validate_challenge($challenge_name, $challenge_moves, $challenge_file){
    // Validates the new challenge data
    $error_message = "";

    $error_message .= $this->validate_name($challenge_name);
    $error_message .= $this->validate_moves($challenge_moves);
    $error_message .= $this->validate_file($challenge_file);

    return $error_message;
  }

  public function generate_filename($conn) {
    // Generate filename based on last ID
    $challenge_filename = "challengemap_" . strval($this->get_last_id($conn) + 1) . ".png";

    return $challenge_filename;
  }

  public function create_challenge($conn, $challenge_name, $challenge_moves, $challenge_file_info) {
    // Generates filename
    $challenge_filename = $this->generate_filename($conn);

    $sql_stmt = "INSERT INTO challenges(name, numberOfMoves, filepath)" . "VALUES(:name, :number_of_moves, :filepath)";

    $prepared_stmt = $conn->prepare($sql_stmt);
    $prepared_stmt->bindParam(":name", $challenge_name);
    $prepared_stmt->bindParam(":number_of_moves", $challenge_moves);
    $prepared_stmt->bindParam(":filepath", $challenge_filename);
    $prepared_stmt->execute();

    return $conn->lastInsertRowID();
  }


  public function search_challenge($conn, $challenge_id){
    $challenges = $this->get_challenges($conn);

    // Returns a particular challenge
    foreach ($challenges as $challenge) {
      if ($challenge->get_id() == $challenge_id) {
        return $challenge;
      }
    }
    return false;
  }

  public function get_challenges($conn){
    $res = $conn->query("SELECT * FROM challenges");
    $temp_array = array();

    while ($row = $res->fetchArray()) {
      array_push($temp_array, new Challenge($row['id'], $row['name'], $row['filepath'], $row['numberOfMoves']));
    }

    if (empty($temp_array)) {
      return false;
    }

    return $temp_array;
  }

  public function edit_challenge_name($conn, $challenge_id, $new_challenge_name) {
    $sql_stmt = "UPDATE challenges SET NAME = :challenge_name WHERE id = :challenge_id";

    $prepared_stmt = $conn->prepare($sql_stmt);

    $prepared_stmt->bindParam(":challenge_name", $new_challenge_name);
    $prepared_stmt->bindParam(":challenge_id", $challenge_id);
    $prepared_stmt->execute();

    return true;
  }

  public function edit_challenge_moves($conn, $challenge_id, $new_challenge_moves) {
    $sql_stmt = "UPDATE challenges SET NUMBEROFMOVES = :challenge_moves WHERE id = :challenge_id";

    $prepared_stmt = $conn->prepare($sql_stmt);

    $prepared_stmt->bindParam(":challenge_moves", $new_challenge_moves);
    $prepared_stmt->bindParam(":challenge_id", $challenge_id);
    $prepared_stmt->execute();

    return true;
  }

  public function edit_challenge_file($conn, $challenge_id, $new_challenge_file) {

    $sql_stmt = "UPDATE challenges SET filepath = :challenge_file WHERE id = :challenge_id";

    $prepared_stmt = $conn->prepare($sql_stmt);

    $prepared_stmt->bindParam(":challenge_file", $new_challenge_file);
    $prepared_stmt->bindParam(":challenge_id", $challenge_id);
    $prepared_stmt->execute();

    return true;
  }

  public function determineNumberOfStars($conn, $challenge_id, $number_of_moves){
    $challenge = $this->search_challenge($conn, $challenge_id);
    $challenge_moves = $challenge->get_number_of_moves();

    if ($number_of_moves <= 0) {
      return false;
    }

    // 3 stars
    if ($number_of_moves <= $challenge_moves) {
      return 3;
    }
    // 2 stars
    elseif ($number_of_moves > $challenge_moves && $number_of_moves <= $challenge_moves * 1.5) {
      return 2;
    }
    // 1 star
    elseif ($number_of_moves > $challenge_moves * 1.5 && $number_of_moves <= $challenge_moves * 2) {
      return 1;
    }
    // no star
     else {
       return 0;
    }

  }

}

$conn = connect();
$challenge_management_obj = new ChallengeManagement();

?>
