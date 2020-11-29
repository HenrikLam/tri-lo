<?php

namespace app\models;

use app\models\Locatioon;

class Listing {
  private $name;
  private $location;
  private $amenities;
  private $price;
  private $owner;
  private $isRenting;
  private $paymentFrequency;
  private $id;
  private $latitude;
  private $longitude;
  private $bedrooms;
  private $bathrooms;

  public function __construct($name, $location, $amenities, $price, $owner, $isRenting, $paymentFrequency, $latitude, $longitude, $bedrooms, $bathrooms, $squareFeet, $timeStamp, $status) {
    $this->name = $name;
    $this->location = $location;
    $this->amenities = $amenities;
    $this->price = $price;
    $this->owner = $owner;
    $this->isRenting = $isRenting;
    $this->paymentFrequency = $paymentFrequency;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->bedrooms = $bedrooms;
    $this->bathrooms = $bathrooms;
    $this->squareFeet = $squareFeet;
    $this->timeStamp = $timeStamp;
    $this->status = $status;
  }

  public static function listConstructor($data) {
    return new Listing(
      $data['listingName'], 
      $data['location'],
      null,
      $data['price'],
      $data['owner'],
      $data['isRenting'],
      $data['paymentFrequency'],
      $data['latitude'],
      $data['longitude'],
      $data['bedrooms'],
      $data['bathrooms'],
      $data['squareFeet'],
      $data['dateTimePosted'],
      $data['status']);
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

  public function getId() {
    return $this->id;
  }

  public function getLatitude() {
    return $this->latitude;
  }

  public function getLongitude() {
    return $this->latitude;
  }

  public function getBedrooms() {
    return $this->bedrooms;
  }

  public function getBathrooms() {
    return $this->bathrooms;
  }

  public function getSquareFeet() {
    return $this->squareFeet;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getTimeStamp() {
    return $this->timeStamp;
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

  public function setId($id) {
    $this->id = $id;
  }

  public function setLatitude($latitude) {
    $this->latitude = $latitude;
  }

  public function setLongitude($latitude) {
    $this->latitude = $latitude;
  }

  public function setBedrooms($bedrooms) {
    $this->bedrooms = $bedrooms;
  }

  public function setBathrooms($bathrooms) {
    $this->bathrooms = $bathrooms;
  }

  public function setSquareFeet($squareFeet) {
    $this->squareFeet = $squareFeet;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function setTimeStamp($timeStamp) {
    $this->timeStamp = $timeStamp;
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