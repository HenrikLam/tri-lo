<?php

namespace app\models;

use app\models\Locatioon;

class Listing {
  private $listingName;
  private $listingId;
  private $location;
  private $owner;
  private $description;
  private $amenities;
  private $rent;
  private $squareFeet;
  private $longitude;
  private $latitude;
  private $bedrooms;
  private $bathrooms;
  private $leaseType;
  private $dateTimePosted;
  private $status;

  public function __construct($listingName, $location, $owner, $description, $amenities, $rent, $squareFeet, $longitude, $latitude, $bedrooms, $bathrooms, $leaseType, $dateTimePosted, $status) {
    $this->listingName = $listingName;
    $this->location = $location;
    $this->owner = $owner;
    $this->description = $description;
    $this->amenities = $amenities;
    $this->rent = $rent;
    $this->squareFeet = $squareFeet;
    $this->longitude = $longitude;
    $this->latitude = $latitude;
    $this->bedrooms = $bedrooms;
    $this->bathrooms = $bathrooms;
    $this->leaseType = $leaseType;
    $this->dateTimePosted = $dateTimePosted;
    $this->status = $status;
  }

  public static function listConstructor($data) {
    return new Listing(
      $data['listingName'], 
      $data['location'],
      $data['owner'],
      $data['description'],
      null,
      $data['rent'],
      $data['squareFeet'],
      $data['longitude'],
      $data['latitude'],
      $data['bedrooms'],
      $data['bathrooms'],
      $data['leaseType'],
      $data['dateTimePosted'],
      $data['status']);
  }

  public function getListingName() {
    return $this->listingName;
  }

  public function getListingId() {
    return $this->listingId;
  }

  public function getLocation() {
    return $this->location;
  }

  public function getOwner() {
    return $this->owner;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getAmenities() {
    return $this->amenities;
  }

  public function getRent() {
    return $this->rent;
  }

  public function getSquareFeet() {
    return $this->squareFeet;
  }

  public function getLongitude() {
    return $this->longitude;
  }

  public function getLatitude() {
    return $this->latitude;
  }

  public function getBedrooms() {
    return $this->bedrooms;
  }

  public function getBathrooms() {
    return $this->bathrooms;
  }

  public function getLeaseType() {
    return $this->leaseType;
  }

  public function getDateTimePosted() {
    return $this->dateTimePosted;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setListingName($listingName) {
    $this->listingName = $listingName;
  }

  public function setListingId($listingId) {
    $this->listingId = $listingId;
  }

  public function setLocation($location) {
    $this->location = $location;
  }

  public function setOwner($owner) {
    $this->owner = $owner;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setAmenities($amenities) {
    $this->amenities = $amenities;
  }

  public function setRent($rent) {
    $this->rent = $rent;
  }

  public function setSquareFeet($squareFeet) {
    $this->squareFeet = $squareFeet;
  }

  public function setLongitude($longitude) {
    $this->longitude = $longitude;
  }

  public function setLatitude($latitude) {
    $this->latitude = $latitude;
  }

  public function setBedrooms($bedrooms) {
    $this->bedrooms = $bedrooms;
  }

  public function setBathrooms($bathrooms) {
    $this->bathrooms = $bathrooms;
  }

  public function setLeaseType($leaseType) {
    $this->leaseType = $leaseType;
  }
  
  public function setTimeStamp($timeStamp) {
    $this->timeStamp = $timeStamp;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function updateAmenity($amenity, $val) {
    $this->amenities[$amenity] = $val;
  } 

  public function removeAmenity($amenity, $val) {
    unset($this->amenities[$amenity]);
  }

  public function toArray() {
    $loc = $this->location->toArray();

    return array_merge($loc,
      ['listingName' => $this->listingName, 
      'listingId' => $this->listingId,
      'owner' => $this->owner,
      'description' => $this->description,
      'amenities' => $this->amenities,
      'rent' => $this->rent,
      'squareFeet' => $this->squareFeet,
      'longitude' => $this->longitude,
      'latitude' => $this->latitude,
      'bedrooms' => $this->bedrooms,
      'bathrooms' => $this->bathrooms,
      'leaseType' => $this->leaseType,
      'dateTimePosted' => $this->dateTimePosted,
      'status' => $this->status]);
  }

}

?>