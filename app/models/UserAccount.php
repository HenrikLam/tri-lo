<?php

abstract class UserAccount {
  protected $firstName;
  protected $lastName;
  protected $username;
  protected $password;
  protected $email;
  protected $userId;

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $lastName;
  }

  public function getFullName() {
    return $firstName . ' ' . $lastName;
  }

  public function getUsername() {
    return $username;
  }

  public function getPassword() {
    return $password;
  }
  
  public function getEmail() {
    return $email;
  }

  public function getUserId() {
    return $userId;
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

}

?>