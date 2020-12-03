<?php

namespace app\models;

use app\models\OwnerAccount;

class AgentAccount extends OwnerAccount {

  public function __construct($firstName, $lastName, $username, $password, $email, $userId, $phoneNumber) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->userId = $userId;
    $this->phoneNumber = $phoneNumber;
  }

  public static function listConstructor($data) {
    return new AgentAccount($data['firstName'],
      $data['lastName'],
      $data['username'],
      $data['password'],
      $data['email'],
      $data['userId'],
      $data['phoneNumber']
      );
  }

}

?>