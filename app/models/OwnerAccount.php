<?php

abstract class OwnerAccount extends UserAccount {
  protected $currentListings;

  public function getCurrentListings() {
    return $this->currentListings;
  }

  public function getPreviousListings() {
    // return previous listings
  }
}

?>