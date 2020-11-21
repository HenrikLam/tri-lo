<?php

class Listing {
  private $name;
  private $location;
  private $amenities;
  private $price;
  private $owner;
  private $isRenting;
  private $paymentFrequency;

  public function __construct($name, $location, $amenities, $price, $owner, $isRenting, $paymentFrequency) {
    $this->name = $name;
    $this->location = $location;
    $this->amenities = $amenities; // associative array
    $this->price = $price;
    $this->owner = $owner;
    $this->isRenting = $isRenting;
    $this->paymentFrequency = $paymentFrequency;
  }

  public function getName() {
    return $this->name;
  }

  public function getLocation() {
    return $this->location;
  }

  public function getAmenities() {
    return $this->amenities;
  }

  public function getPrice() {
    return $this->price;
  }

  public function getOwner() {
    return $this->owner;
  }

  public function getIsRenting() {
    return $this->isRenting;
  }

  public function getPaymentFrequency() {
    return $this->paymentFrequency;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setLocation($location) {
    $this->location = $location;
  }

  public function setAmenities($amenities) {
    $this->amenities = $amenities;
  }

  public function setPrice($price) {
    $this->price = $price;
  }

  public function setOwner($owner) {
    $this->owner = $owner;
  }

  public function setIsRenting($isRenting) {
    $this->isRenting = $isRenting;
  }

  public function setPaymentFrequency($paymentFrequency) {
    $this->paymentFrequency = $paymentFrequency;
  }

  public function updateAmenity($amenity, $val) {
    // if the amenity doesn't exist in the amenities list yet,
    // then it gets added with the new value
    // if it already exists in the listing, we change the value 
    $this->amenities[$amenity] = $val;
  } 

  public function removeAmenity($amenity, $val) {
    unset($this->amenities[$amenity]);
  }

}

?>