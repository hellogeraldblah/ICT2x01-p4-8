<?php

class User {
  // Challenge entity, stores individual challenge
  private $id;
  private $name;
  private $username;
  private $password;

  function __construct($id, $name, $username) {
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
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

  public function get_username() {
    return $this->username;
  }

  public function set_username($username) {
    $this->username = $username;
  }


}


?>
