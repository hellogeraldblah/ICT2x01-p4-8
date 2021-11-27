<?php

// Any constants defined with a __REL_ in the front means that the constant is
// used for any client-side file paths

// define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/");
// define("__DATABASE_DIR__", __ROOT__ . "databases" . "/");

// define("__REL_CHALLENGES_IMG_DIR__",  "/assets/img/challenges" . "/");

class Challenge {
  // Challenge entity, stores individual challenge
  public $id;
  public $name;
  public $filepath;
  public $numberOfMoves;

  function __construct($id, $name, $filepath, $numberOfMoves) {
    $this->id = $id;
    $this->name = $name;
    $this->filepath = $filepath;
    $this->numberOfMoves = $numberOfMoves;
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

  function get_numberOfMoves() {
    return $this->solution;
  }

  function set_numberOfMoves($numberOfMoves) {
    $this->numberOfMoves = $numberOfMoves;
  }

}


?>
