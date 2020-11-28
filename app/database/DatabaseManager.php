<?php

namespace app\database;

use app\models\Location;
use app\models\Listing;
use app\models\Collection;
use app\models\Report;
use app\models\Message;
use app\models\AgentAccount;
use app\models\ClientAccount;
use app\models\LandlordAccount;
use app\models\Group;

class DatabaseManager {

  /*
    Serena is a database master, how do we log in (private variables here?)

    /** @var DatabaseConnection *   ???
    private $databaseConnection;

  */

  public function __construct($databaseConnection) {
    $this->databaseConnection = $databaseConnection
  }

  /**
   * Get the groups a user is a part of
   *
   * @param string $userId The user id of the owner
   * @return Group[]
   */
  public function getGroupsFromUserId($userId){

  }

  /**
   * Get an owner's previous listings
   *
   * @param string $userId The user id of the owner
   * @return Listing[]
   */
  public function getPrevListingsFromUserId($userId) {

  }

  /**
   * Search for listings from a location
   *
   * @param Location $from The location we are searching
   * @param int $pageNum The offset for the query
   * @param int $radius The distance from the location we are looking
   * @param array $filters Filter specifications for the query
   * @return Listing[] of previous/closed listings
   */
  public function getListings(\Location $from, $pageNum, $radius, $filters) {
    //$page_size = 20?

    $query = "SELECT ...(all listing data we need)..., 
      (
        3959 * acos (
          cos ( radians( from.ycoord ) )
          * cos( radians( lis.ycoord ) )
          * cos( radians( lis.xcoord ) - radians( from.xcoord ) )
          + sin ( radians( from.ycoord) )
          * sin( radians( lis.ycoord ) )
          )
      ) AS distance
    FROM currentListings as lis
    WHERE distance < radius
    AND lis.status = 'ACTIVE'";
    // append getQueryStringByAmenities() result
    // ORDER BY $ordering
    // LIMIT $pageNum * $pageSize, $pageSize + 1 (page size + 1 for page indexing)
  }

  /**
   * Get the query string section with filter requirments
   *
   * @param array $filters Filter specifications for the query
   * @return string
   */
  private function getQueryStringByAmenities($filters, $listingId) {
    $query = "";
    foreach ($filters as $key => $value) {
      $query = $query . " AND " . "EXISTS (SELECT * FROM amenities 
                                           WHERE listingId = $listingId 
                                           AND " . $key . " LIKE '%" . $value . "%')"
    }

    return $query;
  }

  /**
   * Attempt to log in a user
   *
   * @param string $username The username attempting to login
   * @param string $password The password attempting to login
   * @return boolean True if the login combination was successful
   */
  public function checkLogIn($username, $password) {

  }

  /**
   * Get the Collection objects (bookmarks) associated with a user
   *
   * @param int $userId The user id of the owner
   * @return Collection[]
   */
  public function getCollectionsFromUserId($userId) {

  }

  /**
   * Get the Collection objects (bookmarks) associated with a user and containing
   * part or all of a string
   *
   * @param int $userId The user id of the owner
   * @param string $cname The search made by the user
   * @return Collection[]
   */
  public function getCollectionFromName($userId, $cname) {

  }

  /**
   * Get the Reports made to a Listing
   *
   * @param int $listingId
   * @return Report[]
   */
  public function getReportsFromListing($listingId) {

  }

  /**
   * Get the user account associated with a username
   *
   * @param string $username
   * @return User
   */
  public function getUserInfoFromUsername($username) {

  }

  /**
   * Save a listing to the database (real listings)
   *
   * @param Listing $listing
   */
  public function saveListing($listing) {

  }

  /**
   * Save a listing to the database (pending listings/not verified yet)
   *
   * @param Listing $listing
   * @param array $info Informationa about the listing (contact/documents) 
   */
  public function requestListing($listing, $info) {

  }

  /**
   * Save an account to the database after sign-up
   *
   * @param UserAccount $account
   */
  public function saveAccount($account) {

  }

  /**
   * Save a collection/bookmark a user has created
   *
   * @param Collection $collection
   */
  public function saveCollection($collection) {

  }

  /**
   * Save a report made on a listing
   *
   * @param Report $report
   */
  public function saveReport($report) {

  }

  /**
   * Save a group object created
   *
   * @param UserAccount $account
   */
  public function saveGroup($group) {

  }

  /**
   * Invite a user to a group
   *
   * @param int $groupId
   * @param UserAccount $user The user getting invited
   */
  public function inviteUserToGroup($groupId, $user) {

  }

  /**
   * Add a user to a group and remove the invitation
   *
   * @param int $groupId
   * @param User $user The user getting added to the group
   */
  public function addUserToGroup($groupId, $user) {

  }

  /**
   * Save a verification code created after a forgot password request
   *
   * @param string $username The account the verification is associated with
   * @param string $code
   */
  public function saveVerificationCode($username, $code)

  /**
   * Check if the latest verification code matches the one given
   *
   * @param string $username The account the verification is associated with
   * @param string $code
   * @return boolean True if the code matches
   */
  public function checkVerificationCode($username, $code) {

  }

}

?>