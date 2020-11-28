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

  public function __construct() {
    $input = func_get_args();

    if (func_num_args() != 1) {
      $input = [
        "address" => $input[0],
        "city" => $input[1],
        "state" => $input[2],
        "zip" => $input[3]
      ];
    }
    else {
      $input = $input[0];
    }

    $this->addressLine = $input["address"] ?? null;
    $this->city = $input["city"] ?? null;
    $this->state = $input["state"] ?? null;
    $this->zipcode = $input["zip"] ?? null;
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