<?php

namespace app\models;

class Location {

  /** @var string */
  private $address;
  /** @var string */
  private $city;
  /** @var string */
  private $state;
  /** @var string */
  private $zipcode;

  public function __construct($address, $city, $state, $zipcode) {
    $this->address = $address;
    $this->city = $city;
    $this->state = $state;
    $this->zipcode = $zipcode;
  }

  public static function listConstructor($data) {
    return new Location($data['address'] ?? null,
      $data['city'] ?? null,
      $data['state'] ?? null,
      $data['zipcode'] ?? null
    );
  }

  public function getAddress() {
    return $this->address;
  }

  public function getCity() {
    return $this->city;
  }

  public function getState() {
    return $this->state;
  }

  public function getZipCode() {
    return $this->zipcode;
  }

  public function setAddress($address) {
    $this->address = $address;
  }

  public function setCity($city) {
    $this->city = $city;
  }

  public function setState($state) {
    $this->state = $state;
  }

  public function setZipcode($zipcode) {
    $this->zipcode = $zipcode;
  }

  public function toArray() {
    $data = [
      "address" => $this->address,
      "city" => $this->city,
      "state" => $this->state,
      "zip" => $this->zipcode
    ];

    return $data;
  }

}

?>