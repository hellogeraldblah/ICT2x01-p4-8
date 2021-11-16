<?php


// Any constants defined with a __REL_ in the front means that the constant is
// used for any client-side file paths

define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
define("__DATABASE_DIR__", __ROOT__ . "databases" . "/");

define("__REL_CHALLENGES_IMG_DIR__",  "/assets/img/challenges" . "/");

function get_db(){

  $db_filepath = __DATABASE_DIR__ . "codar-db.sqlite";

  if (!file_exists($db_filepath)) {
    return false;
  }

  $db = new SQLite3($db_filepath);

  return $db;

}

class Challenge {
  // Challenge entity, stores individual challenge
  public $id;
  public $name;
  public $filepath;
  public $solution;

  function __construct($id, $name, $filepath, $solution) {
    $this->id = $id;
    $this->name = $name;
    $this->filepath = $filepath;
    $this->solution = $solution;
  }

  function get_name() {
    return $this->name;
  }

  function set_name($name) {
    $this->name = $name;
  }

  function get_filepath() {
    return $this->filepath;
  }

  function set_filepath($filepath) {
    $this->filepath = $filepath;
  }

  function get_solution() {
    return $this->solution;
  }

  function set_solution($solution) {
    $this->solution = $solution;
  }

}

class Challenges_List {
  // Challenge_List entity, stores array of Challenge objects
  public $challenges = array();

  function populate_challenges() {
    //
    $db = get_db();
    $res = $db->query("SELECT * FROM challenges");

    while ($row = $res->fetchArray()) {
      array_push($this->challenges, new Challenge($row['id'], $row['name'], __REL_CHALLENGES_IMG_DIR__ . $row['filepath'], $row['solution']));
    }
  }

  function get_challenges_list(){
    // Returns the entire array of challenges
    return $this->challenges;
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

}

$challenge_list_obj = new Challenges_List();
$challenge_list_obj->populate_challenges();

$challenge_list = $challenge_list_obj->get_challenges_list();


?>
