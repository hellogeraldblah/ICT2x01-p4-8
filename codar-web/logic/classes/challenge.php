<?php

class Challenge {
  // Challenge entity, stores individual challenge
  public $id;
  public $name;
  public $filepath;
  public $number_of_moves;

  function __construct($id, $name, $filepath, $number_of_moves) {
    $this->id = $id;
    $this->name = $name;
    $this->filepath = $filepath;
    $this->number_of_moves = $number_of_moves;
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

  function get_number_of_moves() {
    return $this->number_of_moves;
  }

  function set_number_of_moves($number_of_moves) {
    $this->number_of_moves = $number_of_moves;
  }

}


?>
