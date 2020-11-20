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
    private $database_connection;

  */

  public function __construct($database_connection) {
    $this->database_connection = $database_connection
  }

  /**
   * Get the groups a user is a part of
   *
   * @param string $user_id The user id of the owner
   * @return Group[]
   */
  public function getGroupsFromUserId($user_id){

  }

  /**
   * Get an owner's previous listings
   *
   * @param string $user_id The user id of the owner
   * @return Listing[]
   */
  public function getPrevListingsFromUserId($user_id) {

  }

  /**
   * Search for listings from a location
   *
   * @param Location $from The location we are searching
   * @param int $page_num The offset for the query
   * @param int $radius The distance from the location we are looking
   * @param array $filters Filter specifications for the query
   * @return Listing[] of previous/closed listings
   */
  public function getListings(\Location $from, $page_num, $radius, $filters) {

  }

  /**
   * Get the query string section with filter requirments
   *
   * @param array $filters Filter specifications for the query
   * @return string
   */
  private function getQueryStringByAmenities($filters) {

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
   * @param int $user_id The user id of the owner
   * @return Collection[]
   */
  public function getCollectionsFromUserId($user_id) {

  }

  /**
   * Get the Collection objects (bookmarks) associated with a user and containing
   * part or all of a string
   *
   * @param int $user_id The user id of the owner
   * @param string $cname The search made by the user
   * @return Collection[]
   */
  public function getCollectionFromName($user_id, $cname) {

  }

  /**
   * Get the Reports made to a Listing
   *
   * @param int $listing_id
   * @return Report[]
   */
  public function getReportsFromListing($listing_id) {

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
  public function saveGroup(group: Group) {

  }

  /**
   * Invite a user to a group
   *
   * @param int $group_id
   * @param UserAccount $user The user getting invited
   */
  public function inviteUserToGroup($group_id, $user) {

  }

  /**
   * Add a user to a group and remove the invitation
   *
   * @param int $group_id
   * @param User $user The user getting added to the group
   */
  public function addUserToGroup($group_id, $user) {

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