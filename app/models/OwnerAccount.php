<?php

namespace app\models;

use app\models\UserAccount;

abstract class OwnerAccount extends UserAccount {

  public function getCurrentListings() {
    // return current listings
  }

  public function getPreviousListings() {
    // return previous listings
  }
}

?>