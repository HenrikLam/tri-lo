<?php

namespace app\models;

use app\models\UserAccount;

abstract class OwnerAccount extends UserAccount {

  protected $phoneNumber;

  public function setPhoneNumber($phoneNumber) {
    $this->phoneNumber = $phoneNumber;
  }

  public function getPhoneNumber() {
    return $this->phoneNumber;
  }

  public function getCurrentListings() {
    // return current listings
  }

  public function getPreviousListings() {
    // return previous listings
  }

  public function toArray() {
    return [
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'username' => $this->username,
      'email' => $this->email,
      'userId' => $this->userId,
      'phoneNumber' => $this->phoneNumber,
      'profilePicture' => $this->profilePicture];
  }
}

?>