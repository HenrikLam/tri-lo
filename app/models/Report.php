<?php

namespace app\models;

class Report {
  private $userId;
  private $listingId;
  private $reason;

  public function __construct($userId, $listingId, $reason) {
    $this->userId = $userId;
    $this->listingId = $listingId;
    $this->reason = $reason;
  }

  public function getUserId() {
    return $this->userId;
  }

  public function getListingId() {
    return $this->listingId;
  }

  public function getReason() {
    return $this->reason;
  }

  public function setUserId($userId) {
    $this->userId = $userId;
  }

  public function setListingId($listingId) {
    $this->listingId = $listingId;
  }

  public function setReason($reason) {
    $this->reason = $reason;
  }

  public function send() {
    // maybe send an email to the listing owner that his/her
    // listing was reported
  }

}

?>