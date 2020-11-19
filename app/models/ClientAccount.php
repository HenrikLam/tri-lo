<?php

class ClientAccount extends UserAccount {

  public function __construct($firstName, $lastName, $username, $password, $email) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
  }

  public function getGroups() {
    // return groups that client is in
  }
}

?>