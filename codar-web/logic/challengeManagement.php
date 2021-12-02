<?php

if(!defined("__ROOT__")) define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
// define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
if(!defined("__REL_CHALLENGES_IMG_DIR__"))define("__REL_CHALLENGES_IMG_DIR__",  "/assets/img/challenges" . "/");

if(!defined("__MAX_CHALLENGE_MOVES__")) define("__MAX_CHALLENGE_MOVES__", 100); # Maximum moves a challenge can have
if(!defined("__MAX_FILE_SIZE__")) define("__MAX_FILE_SIZE__", 5000000); # Maximum challenge file size: 5mb

require_once "../databases/database.php";
require_once "../logic/classes/challenge.php";

class ChallengeManagement {
  // Challenge_List entity, stores array of Challenge objects
  private $challenges = array();
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
    $res = $this->conn->query("SELECT * FROM challenges");

    while ($row = $res->fetchArray()) {
      array_push($this->challenges, new Challenge($row['id'], $row['name'], __REL_CHALLENGES_IMG_DIR__ . $row['filepath'], $row['numberOfMoves']));
    }
  }

  private function get_last_id() {
    $number_of_rows = $this->conn->querySingle("SELECT COUNT(*) as COUNT FROM challenges");
    return $number_of_rows;
  }

  public function validate_name($challenge_name) {
    $error_message = "";

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
    }

    if ($challenge_moves > __MAX_CHALLENGE_MOVES__) {
      $error_message .= "Challenge Moves cannot be more than " . __MAX_CHALLENGE_MOVES__ . ". \\n";
    }

    return $error_message;

  }

  public function validate_file($challenge_file_info) {
    $error_message = "";

    // Check file size
    if ($challenge_file_info["fileToUpload"]["size"] > __MAX_FILE_SIZE__) {
      $error_message .= "Challenge File is too large. \\n";
    }

    // Check if image file is a actual image or fake image
    $check = getimagesize($challenge_file_info["fileToUpload"]["tmp_name"]);
    if($check == false) {
      $error_message .= "Challenge File is not an image. \\n";
    }

    // Allow only jpg, png and jpeg file formats
    $imageFileExt = strtolower(pathinfo($challenge_file_info["fileToUpload"]["name"], PATHINFO_EXTENSION));
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

  private function upload_file($challenge_file_info, $challenge_file_name) {
    // Generate absolute filename
    $target_file = __UPLOADS_DIR__ . $challenge_file_name;

    move_uploaded_file($challenge_file_info["fileToUpload"]["tmp_name"], $target_file);

    return $target_file;
  }

  public function generate_filename() {
    // Generate filename based on last ID
    $challenge_filename = "challengemap_" . strval($this->get_last_id() + 1) . ".png";

    return $challenge_filename;
  }

  public function create_challenge($challenge_name, $challenge_moves, $challenge_file_info) {
    // Generates filename
    $challenge_filename = $this->generate_filename();

    // Upload file
    $this->upload_file($challenge_file_info, $challenge_filename);

    $sql_stmt = "INSERT INTO challenges(name, numberOfMoves, filepath)" . "VALUES(:name, :number_of_moves, :filepath)";

    $prepared_stmt = $this->conn->prepare($sql_stmt);
    $prepared_stmt->bindParam(":name", $challenge_name);
    $prepared_stmt->bindParam(":number_of_moves", $challenge_moves);
    $prepared_stmt->bindParam(":filepath", $challenge_filename);
    $prepared_stmt->execute();

    return $this->conn->lastInsertRowID();
  }

  public function search_challenge($challenge_id){
    // Returns a particular challenge
    foreach ($this->challenges as $challenge) {
      if ($challenge->id == $challenge_id) {
        return $challenge;
      }
    }
    return false;
  }

  public function get_challenges(){
    // Returns a list of challenges
    return $this->challenges;
  }

  public function edit_challenge_name($challenge_id, $new_challenge_name) {
    $sql_stmt = "UPDATE challenges SET NAME = :challenge_name WHERE id = :challenge_id";

    $prepared_stmt = $this->conn->prepare($sql_stmt);

    $prepared_stmt->bindParam(":challenge_name", $new_challenge_name);
    $prepared_stmt->bindParam(":challenge_id", $challenge_id);
    $prepared_stmt->execute();
  }

  public function edit_challenge_moves($challenge_id, $new_challenge_moves) {
    $sql_stmt = "UPDATE challenges SET NUMBEROFMOVES = :challenge_moves WHERE id = :challenge_id";

    $prepared_stmt = $this->conn->prepare($sql_stmt);

    $prepared_stmt->bindParam(":challenge_moves", $new_challenge_moves);
    $prepared_stmt->bindParam(":challenge_id", $challenge_id);
    $prepared_stmt->execute();
  }

  public function edit_challenge_file($challenge_id, $new_challenge_file) {
    $new_challenge_file = "challengemap_" . $challenge_id . ".png";

    $this->upload_file($new_challenge_file);

    $sql_stmt = "UPDATE challenges SET filepath = :challenge_file WHERE id = :challenge_id";

    $prepared_stmt = $this->conn->prepare($sql_stmt);

    $prepared_stmt->bindParam(":challenge_file", $new_challenge_file);
    $prepared_stmt->bindParam(":challenge_id", $challenge_id);
    $prepared_stmt->execute();
  }

  public function determineNumberOfStars($challenge_id, $number_of_moves){
    $challenge = $this->search_challenge($challenge_id);
    $challenge_moves = $challenge->number_of_moves;

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
$challenge_list_obj = new ChallengeManagement($conn);

?>
