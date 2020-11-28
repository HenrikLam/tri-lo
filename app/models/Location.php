<?php

namespace app\models;

class Location {

  /** @var string */
  private $address_line_1;
  /** @var string */
  private $address_line_2;
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
        "line1" => $input[0],
        "line2" => $input[1],
        "city" => $input[2],
        "state" => $input[3],
        "zip" => $input[4]
      ];
    }
    else {
      $input = $input[0];
    }

    $this->address_line_1 = $input["line1"] ?? null;
    $this->address_line_2 = $input["line2"] ?? null;
    $this->city = $input["city"] ?? null;
    $this->state = $input["state"] ?? null;
    $this->zipcode = $input["zip"] ?? null;
  }

  public function getAddressLine1() {
    return $this->address_line_1;
  }

  public function getAddressLine2() {
    return $this->address_line_2;
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

  public function setAddressLine1($address_line_1) {
    $this->address_line_1 = $address_line_1;
  }

  public function setAddressLine2($address_line_2) {
    $this->address_line_2 = $address_line_2;
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
      "line1" => $this->address_line_1,
      "line2" => $this->address_line_2,
      "city" => $this->city,
      "state" => $this->state,
      "zip" => $this->zipcode
    ];

    return $data;
  }

}

?>