<?php


define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
// define("__UPLOADS_DIR__", __ROOT__ . "assets/img/challenges/");
define("__REL_CHALLENGES_IMG_DIR__",  "/assets/img/challenges" . "/");

define("__MAX_CHALLENGE_MOVES__", 100); # Maximum moves a challenge can have
define("__MAX_FILE_SIZE__", 5000000); # Maximum challenge file size: 5mb

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

  private function validate_name($challenge_name) {
    $error_message = "";

    if (strlen($challenge_name ) > 100) {
      $error_message .= "Challenge Name must be within 100 characters. \\n";
    }

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $challenge_name)){
      $error_message .= "Challenge Name cannot contain special characters. \\n";
    }

    return $error_message;

  }

  private function validate_moves($challenge_moves) {
    $error_message = "";

    if ($challenge_moves > __MAX_CHALLENGE_MOVES__) {
      $error_message .= "Challenge Moves cannot be more than " . __MAX_CHALLENGE_MOVES__;
    }

    return $error_message;

  }

  private function validate_map($challenge_file) {
    $error_message = "";

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > __MAX_FILE_SIZE__) {
      $error_message .= "Challenge File is too large. \\n";
    }

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check == false) {
      $error_message .= "Challenge File is not an image. \\n";
    }

    // Allow only jpg, png and jpeg file formats
    $imageFileExt = strtolower(pathinfo($challenge_file, PATHINFO_EXTENSION));
    if($imageFileExt != "jpg" && $imageFileExt != "png" && $imageFileExt != "jpeg") {
      $error_message .= "Challenge File only accepts JPG, JPEG, PNG extensions. \\n";
    }

    return $error_message;
  }

  private function validate_challenge($challenge_name, $challenge_moves, $challenge_file){
    // Validates the new challenge data
    $error_message .= $this->validate_name($challenge_name);
    $error_message .= $this->validate_moves($challenge_moves);
    $error_message .= $this->validate_map($challenge_file);

    return $error_message;
  }

  public function create_challenge($challenge_name, $challenge_moves, $challenge_file) {
    // Creates a new challenge
    $challenge_file = "challengemap_" . strval($this->get_last_id() + 1) . ".png";

    $target_file = __UPLOADS_DIR__ . $challenge_file;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    $sql_stmt = "INSERT INTO challenges(name, numberOfMoves, filepath)" . "VALUES(:name, :numberOfMoves, :filepath)";

    $prepared_stmt = $this->conn->prepare($sql_stmt);
    $prepared_stmt->bindParam(":name", $challenge_name);
    $prepared_stmt->bindParam(":numberOfMoves", $challenge_moves);
    $prepared_stmt->bindParam(":filepath", $challenge_file);
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

  function edit_challenge(){

  }

  public function determineNumberOfStars($challenge_id, $number_of_moves){
    $challenge = $this->search_challenge($challenge_id);
    $challenge_moves = $challenge->numberOfMoves;

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

?>
