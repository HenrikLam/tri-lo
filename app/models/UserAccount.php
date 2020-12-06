<?php

namespace app\models;

abstract class UserAccount {
  protected $firstName;
  protected $lastName;
  protected $username;
  protected $password;
  protected $email;
  protected $userId;
  protected $profilePicture;

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function getFullName() {
    return $this->firstName . ' ' . $this->lastName;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }
  
  public function getEmail() {
    return $this->email;
  }

  public function getUserId() {
    return $this->userId;
  }

  public function getProfilePicture() {
    return $this->profilePicture;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function setUsername($username) {
    $this->username = $username;
  }
  
  public function setPassword($password) {
    $this->password = $password;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setUserId($userId) {
    $this->userId = $userId;
  }

  public function setProfilePicture($profilePicture) {
    $this->profilePicture = $profilePicture;
  }

  public static function listConstructor($data) {
    if ($data['accountType'] == 'Client') {
      return ClientAccount::listConstructor($data);
    }
    elseif ($data['accountType'] == 'Landlord') {
      return LandlordAccount::listConstructor($data);
    }
    else {
      return AgentAccount::listConstructor($data);
    }
  }

  public function toArray() {
    return [
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'username' => $this->username,
      'email' => $this->email,
      'userId' => $this->userId,
      'profilePicture' => $this->profilePicture];
  }

}

?>