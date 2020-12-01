<?php

namespace app\models;

use app\models\UserAccount;

class ClientAccount extends UserAccount {

  public function __construct($firstName, $lastName, $username, $password, $email) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
  }

  public static function listConstructor($data) {
    return new ClientAccount($data['firstName'],
      $data['lastName'],
      $data['username'],
      $data['password'],
      $data['email']
      );
  }

  public function getGroups() {
    // return groups that client is in
  }
}

?>