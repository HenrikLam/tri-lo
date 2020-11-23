<?php 

class Collection {
  private $name;
  private $ownerId;
  private $listings;

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

  public function getLstings() {
    return $this->listings;
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



}

?>