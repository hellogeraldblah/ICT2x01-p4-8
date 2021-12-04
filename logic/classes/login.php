<?php

class Login {
  // Signup entity, stores individual information
  public $email;
  public $password;

  function __construct($email, $password) {
    $this->email = $email;
    $this->password = $password;
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
