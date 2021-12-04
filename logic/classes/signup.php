<?php

class Signup {
  // Signup entity, stores individual information
  public $id;
  public $name;
  public $email;
  public $password;

  function __construct($id, $name, $email, $password) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  function get_name() {
    return $this->name;
  }

  function set_name($name) {
    $this->name = $name;
  }

  function get_email() {
    return $this->email;
  }

  function set_email($email) {
    $this->email = $email;
  }

  function get_password() {
    return $this->password;
  }

  function set_password($password) {
    $this->password = $password;
  }

}


?>
