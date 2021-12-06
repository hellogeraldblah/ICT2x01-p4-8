<?php

class Challenge {
  // Challenge entity, stores individual challenge
  private $id;
  private $name;
  private $filepath;
  private $number_of_moves;

  function __construct($id, $name, $filepath, $number_of_moves) {
    $this->id = $id;
    $this->name = $name;
    $this->filepath = $filepath;
    $this->number_of_moves = $number_of_moves;
  }

  public function get_id() {
    return $this->id;
  }

  public function get_name() {
    return $this->name;
  }

  public function set_name($name) {
    $this->name = $name;
  }

  public function get_filepath() {
    return $this->filepath;
  }

  public function set_filepath($filepath) {
    $this->filepath = $filepath;
  }

  public function get_number_of_moves() {
    return $this->number_of_moves;
  }

  public function set_number_of_moves($number_of_moves) {
    $this->number_of_moves = $number_of_moves;
  }

}


?>
