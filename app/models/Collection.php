<?php 

namespace app\models; 

use app\models\Location;
use app\models\Listing;

class Collection {
  private $name;
  private $ownerId;
  private $listings;
  private $collectionId;

  public function __construct($name, $ownerId, $listings) {
    $this->name = $name;
    $this->ownerId = $ownerId;
    $this->listings = $listings;
  }

  public function getName() {
    return $this->name;
  }

  public function getOwnerId() {
    return $this->ownerId;
  }

  public function getListings() {
    return $this->listings;
  }

  public function getCollectionId() {
    return $this->collectionId;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setOwnerId($ownerId) {
    $this->ownerId = $ownerId;
  }

  public function setListings($listings) {
    $this->listings = $listings;
  }

  public function setCollectionId($collectionId) {
    $this->collectionId = $collectionId;
  }

  public function addListing($listing) {
    if (!($index = array_search($listing, $this->listings)) !== false) {
      // if listing is not in collection, then add it
      array_push($this->listings, $listing);
    }
  }

  public function removeListing($listing) {
    if (($index = array_search($listing, $this->listings)) !== false) {
      // use array_search to get the key of the listing
      // if the listing doesn't exist in the collection, $key is null
      unset($this->listings[$index]);
    }
  }

  public function sortListingsByName() {
    // sort listings by name
    usort($this->listings, function($a, $b) {return strcmp($a->name, $b->name);});
  }

  public function toArray() {
    
    $lis = [];
    foreach ($this->listings as $l) {
      $lis[] = $l->toArray();
    }

    return [
      'name' => $this->name,
      'ownerId' => $this->ownerId,
      'collectionId' => $this->collectionId,
      'listings' => $lis
    ];
  }



}

?>
