<?php

class ChallengeManagement {
  // Challenge_List entity, stores array of Challenge objects
  private $challenges = array();
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
    $res = $this->conn->query("SELECT * FROM challenges");

    while ($row = $res->fetchArray()) {
      array_push($this->challenges, new Challenge($row['id'], $row['name'], __REL_CHALLENGES_IMG_DIR__ . $row['filepath'], $row['solution']));
    }
  }

  function validate_challenge(){
    
  }

  function create_challenge($id, $name, $filepath, $solution) {
    // $latest_challenge = new Challenge($row['id'], $row['name'], __REL_CHALLENGES_IMG_DIR__ . $row['filepath'], $row['solution']);
    //
    // $sql_stmt = "INSERT INTO challenges(id, name, filepath, solution)" . "VALUES(:id, :name, :filepath, :solution)";
    //
    // $prepared_stmt = $this->db->prepare($sql_stmt);
    // $prepared_stmt->execute([":id" => $id, ":name" , ":filepath" , ":solution"])
  }

  function get_challenges(){
    // Returns a list of challenges
    return $this->challenges;
  }

  function edit_challenge(){

  }

  function search_challenge($target_id){
    // Locates the particular challenge with the given $target_id and returns the corresponding challenge object
    foreach ($this->challenges as $challenge) {
      if ($challenge->id == $target_id) {
        return $challenge;
      }
    }
    return false;
  }

  function determineNumberOfStars(){

  }

}

?>
