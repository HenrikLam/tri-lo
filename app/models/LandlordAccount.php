<?php

abstract class LandlordAccount extends OwnerAccount {
  
  public function __construct($firstName, $lastName, $username, $password, $email, $currentListings) {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->currentListings = $currentListings;
  }

}

?>