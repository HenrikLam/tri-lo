<?php

namespace app\database;

use app\models\Location;
use app\models\Listing;
use app\models\Collection;
use app\models\Report;
use app\models\Message;
use app\models\UserAccount;
use app\models\AgentAccount;
use app\models\ClientAccount;
use app\models\LandlordAccount;
use app\models\Group;

class DatabaseManager {

  private static $instance = null;
  private $databaseConnection = null;
  private $dbOk = false;

  private function __construct() {
    $this->databaseConnection = new \mysqli('localhost', 'root', '', 'tri-lo');

    if ($this->databaseConnection->connect_error) {
      echo '<div class="messages">Could not connect to the database. Error: ';
      echo $this->databaseConnection->connect_errno . ' - ' . $this->databaseConnection->connect_error . '</div>';
    } 
    else {
      $dbOk = true; 
    }
  }

  /**
   * Get the singleton instance
   * @return DatabaseManager
   */
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new DatabaseManager();
    }

    return self::$instance;
  }

  /**
   * Get the groups a user is a part of
   *
   * @param string $userId The user id of the owner
   * @return Group[]
   */
  public function getGroupsFromUserId($userId){
     $query = "SELECT * 
    FROM groupMembers
    WHERE groupMembers.memberId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $userId);
    $result = $stmt->execute();

    $return = [];
    foreach ($stmt->get_result() as $row) {
      $return[] = $this->getGroupFromGroupId($row['groupId']);
    }

    return $return;
  }

  /**
   * Generate a Listing object from a row of the database
   * @param array $row
   * @return Listing
   */
  private function constructListingFromRow($row){
    // Generate associated objects for the listing
    $row['location'] = new Location($row);
    $row['owner'] = $this->getUserInfoFromUserId($row['ownerId']);

    // Create the listing
    $lis = Listing::listConstructor($row);
    $lis->setId($row['listingId']);
    $lis->setAmenities($this->getAmenitiesFromListingId($row['listingId']));

    return $lis;
  }

  /**
   * Get an owner's listings with a specific status
   *
   * @param int $userId The user id of the owner
   * @param string $status The status we are lookign for
   * @return Listing[]
   */
  public function getListingsFromUserIdAndStatus($userId, $status) {
    $query = "SELECT * 
    FROM listings 
    WHERE ownerID=? 
    AND status != ?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("ds", $userId, $status);
    $result = $stmt->execute();

    $return = [];
    foreach ($stmt->get_result() as $row) {
      // Append listing
      $return[] = $this->constructListingFromRow($row);
    }

    return $return;
  }

  /**
   * Get an owner's current listings
   *
   * @param int $userId The user id of the owner
   * @return Listing[]
   */
  public function getCurrListingsFromUserId($userId) {
    return $this->getListingsFromUserIdAndStatus($userId, "ACTIVE");
  }

  /**
   * Get an owner's previous listings
   *
   * @param int $userId The user id of the owner
   * @return Listing[]
   */
  public function getPrevListingsFromUserId($userId) {
    return $this->getListingsFromUserIdAndStatus($userId, "PREVIOUS");
  }

  /**
   * Get all of the amenity info from a listing
   * @param int $listingId
   * @return array
   */
  public function getAmenitiesFromListingId($listingId) {
    $query = "SELECT * 
    FROM listingAmenities 
    WHERE listingId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $listingId);
    $result = $stmt->execute();

    $return = [];
    foreach ($stmt->get_result() as $row) {
      // Append amenity pair
      $return[$row['amenity']] = $row['amenityValue'];
    }

    return $return;
  }

  /**
   * Get a listing from listingId
   *
   * @param int $listingId
   * @return Listing
   */
  public function getListingFromListingId($listingId) {
    $query = "SELECT * 
    FROM listings 
    WHERE listingId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $listingId);
    $result = $stmt->execute();

    $return = null;
    $row = $stmt->get_result()->fetch_assoc();

    if (isset($row)) {
      // Append listing
      $return = $this->constructListingFromRow($row);
    }

    return $return;
  }

  /**
   * Search for listings from a location
   *
   * @param float $latitude
   * @param float $longitude
   * @param int $pageNum The offset for the query
   * @param int $radius The distance from the location we are looking
   * @param array $filters Filter specifications for the query
   * @return Listing[] of previous/closed listings
   */
  public function getListingsFromSearch(Location $latitude, $longitude, $pageNum, $radius, $filters) {
    //$page_size = 20?
    // get listing ids of listings that are within the radius
    $baseQuery = "SELECT * 
    FROM listings 
    WHERE (
        3959 * acos (
          cos ( radians( ? [fromLatitude] ) )
          * cos( radians( lis.ycoord ) )
          * cos( radians( lis.xcoord ) - radians( ? [fromLongitude] ) )
          + sin ( radians( ? [fromLatitude] ) )
          * sin( radians( lis.ycoord ) )
          )
      ) < $radius
    AND status = 'ACTIVE'";

    $basicFeatures = $this->getQueryStringByBasicFeatures($filters);
    $baseQuery = $filterQuery . $basicFeatures;

    $filterQuery = $this->getQueryStringByAmenities($filters);
    $query = $filterQuery . " INTERSECT " . $baseQuery;

    // ORDER BY $ordering
    // LIMIT $pageNum * $pageSize, $pageSize + 1 (page size + 1 for page indexing)
    
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("fff", $latitude, $longitude, $latitude);
    $result = $stmt->execute();

    $return = [];
    foreach ($stmt->get_result() as $row) {
      // Append listing
      $return[] = $this->constructListingFromRow($row);
    }

    return $return;
  }

  /**
   * Get the query string section with basic requirments
   *
   * @param array $filters Filter specifications for the query
   * @return string
   */
  private function getQueryStringByBasicFeatures($filters) {
    $query = "";

    // add check for price range
    if (isset($filters['startingPrice'])) {
      $query = $query . "AND price >= " . $filters['startingPrice'] .
                                "AND price <= " . $filters['endingPrice'];
      unset($filters['startingPrice']);
      unset($filters['endingPrice']);
    }

    // add check for rooms and squareFeet
    if (isset($filters['bedrooms'])) {
      $query = $query . "AND bedrooms >= " . $filters['bedrooms'];
      unset($filters['bedrooms']);
    }

    // add check for rooms and squareFeet
    if (isset($filters['bathrooms'])) {
      $query = $query . "AND bathrooms >= " . $filters['bathrooms'];
      unset($filters['bathrooms']);
    }

    // add check for rooms and squareFeet
    if (isset($filters['squareFeet'])) {
      $query = $query . "AND squareFeet >= " . $filters['squareFeet'];
      unset($filters['squareFeet']);
    }

    return $query;
  }

  /**
   * Get the query string section with filter requirments
   *
   * @param array $filters Filter specifications for the query
   * @return string
   */
  private function getQueryStringByAmenities($filters/*, $listingId*/) {
    // get the unique listing ids that satisfy the filters 
    $query = "SELECT DISTINCT listingId 
              FROM listingAmenities 
              WHERE ";
    $count = 0;
    foreach ($filters as $key => $value) {
      // for each filter, make sure the tuple has the amenity as well as the desired value
      if ($count > 0 ) {
        $query = $query . " AND ";
      }
      $query = $query . "lower(amenity) = lower(" . $key . ") AND lower(amenityValue) = lower(" . $value . ")";
      $count += 1;
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
    $query = "SELECT * 
    FROM users  
    WHERE username='$username' AND password='$password'
    LIMIT 1";

    $result = $this->databaseConnection->query($query);
    $numRecords = $result->num_rows;

    return $numRecords == 1;
  }

  /**
   * Get the Collection objects (bookmarks) associated with a user
   *
   * @param int $userId The user id of the owner
   * @return Collection[]
   */
  public function getCollectionsFromUserId($userId) {
    $query = "SELECT * 
    FROM collections  
    INNER JOIN collectionListings as cl
    ON collections.collectionId = cl.collectionId
    INNER JOIN listings 
    ON listings.listingId=cl.listingId 
    WHERE collections.ownerID=?
    ORDER BY collections.collectionId";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $userId);
    $result = $stmt->execute();

    $collections = [];
    foreach ($stmt->get_result() as $row) {
      if (!isset($collections[$row['collectionName']])) {
        $collections[$row['collectionName']] = [];
      }

      // Append listing
      $collections[$row['collectionName']][] = $this->constructListingFromRow($row);
    }

    $return = [];
    foreach ($collections as $name => $listings) {
      $return[] = new Collection($name, $userId, $listings);
    }

    return $return;
  }

  /**
   * Get the Collection objects (bookmarks) associated with a user and containing
   * part or all of a string
   *
   * @param int $userId The user id of the owner
   * @param string $cname The search made by the user
   * @return Collection[]
   */
  public function getCollectionsFromName($userId, $cname) {
    $cname = "%{$cname}%";
    $query = "SELECT * 
    FROM collections  
    INNER JOIN collectionListings as cl
    ON collections.collectionId = cl.collectionId AND collections.collectionName LIKE ?
    INNER JOIN listings 
    ON listings.listingId=cl.listingId
    WHERE collections.ownerID=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("sd", $cname, $userId);
    $result = $stmt->execute();

    $collections = [];
    foreach ($stmt->get_result() as $row) {
      if (!isset($collections[$row['collectionName']])) {
        $collections[$row['collectionName']] = [];
      }

      // Append listing
      $collections[$row['collectionName']][] = $this->constructListingFromRow($row);
    }

    $return = [];
    foreach ($collections as $name => $listings) {
      $return[] = new Collection($name, $userId, $listings);
    }

    return $return;
  }

  /**
   * Get the Reports made to a Listing
   *
   * @param int $listingId
   * @return Report[]
   */
  public function getReportsFromListing($listingId) {
    $query = "SELECT * 
    FROM reports  
    WHERE reports.listingId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $listingId);
    $result = $stmt->execute();

    foreach ($stmt->get_result() as $row) {
      $return[] = new Report($row['userId'], $row['listingId'], $row['reasonForReport']);
    }

    return $return;
  }

  /**
   * Get the user account associated with a username
   *
   * @param string $username
   * @return UserAccount
   */
  public function getUserInfoFromUsername($username) {
    $query = "SELECT users.*, owners.phoneNumber
    FROM users 
    LEFT JOIN owners
    ON owners.userId = users.userId
    WHERE users.username=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $username);
    $result = $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();

    if (!isset($row)) {
      return null;
    }
    else {
      $user = UserAccount::listConstructor($row);
      $user->setUserId($row['userId']);
      return $user;
    }
  }

  /**
   * Get the user account associated with a user id
   *
   * @param string $username
   * @return UserAccount
   */
  public function getUserInfoFromUserId($userId) {
    $query = "SELECT users.*, owners.phoneNumber
    FROM users
    LEFT JOIN owners
    ON owners.userId = users.userId
    WHERE users.userId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $userId);
    $result = $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();

    if (!isset($row)) {
      return null;
    }
    else {
      $user = UserAccount::listConstructor($row);
      $user->setUserId($row['userId']);
      return $user;
    }
  }

  /**
   * Save a listing to the database (real listings)
   *
   * @param OwnerAccount $user
   * @param Listing $listing
   */
  public function saveListing($listing) {
    $listingName = $listing->getListingName();
    $description = $listing->getDescription();
    $ownerId = $listing->getOwner()->getUserId();
    $rent = $listing->getRent();
    $address = $listing->getLocation()->getAddress();
    $city = $listing->getLocation()->getCity();
    $state = $listing->getLocation()->getState();
    $zipcode = $listing->getLocation()->getZipcode();
    $latitude = $listing->getLatitude();
    $longitude = $listing->getLongitude();
    $bedrooms = $listing->getBedrooms();
    $bathrooms = $listing->getBathrooms();
    $squareFeet = $listing->getSquareFeet();
    $timeStamp = $listing->getDateTimePosted();
    $leaseType = $listing->getLeaseType();
    $status = $listing->getStatus();

    $query = "INSERT INTO listings (listingName, ownerId, description, rent, address, city, state, zipcode, ";
    $query = $query . "latitude, longitude, bedrooms, bathrooms,  ";
    $query = $query . "squareFeet, leaseType, dateTimePosted, status) ";
    $query = $query . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $this->databaseConnection->prepare($query);

    // sissssss ssss ssss
    $stmt->bind_param("sissssssssssssss", $listingName,
                                         $ownerId,
                                         $description,
                                         $rent,
                                         $address,
                                         $city,
                                         $state,
                                         $zipcode,
                                         $latitude,
                                         $longitude,
                                         $bedrooms,
                                         $bathrooms,
                                         $squareFeet,
                                         $leaseType,
                                         $dateTimePosted,
                                         $status);
    $stmt->execute();

    if (!$stmt->error == '') {
      $stmt->close();
      return false;
    }

    $listingId = $this->databaseConnection->insert_id;

    $stmt->close();

    if (!is_null($filters)) {
      // add amenities to listingAmenities
      foreach ($filters as $key => $value) {
        // for each filter, add a tuple to the table
        $query = "INSERT INTO listingAmenities (listingId, amenity, amenityValue) VALUES (?,?,?)";
        // not sure how to get the listingId since we fill that out automatically
        $stmt = $this->databaseConnection->prepare($query);
        $statement->bind_param("dss", $listingId, $key, $value);
        $stmt->execute();

        if (!$stmt->error == '') {
          $stmt->close();
          return false;
        }

        $stmt->close();
      }
    }

    return $listingId;    
  }

  /**
   * Get images for a listing
   * 
   * @param int $listingId
   * @return string[]
   */
  public function getImagesFromListingId($listingId) {
    $query = "SELECT * 
    FROM images  
    WHERE images.listingId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $listingId);
    $result = $stmt->execute();

    foreach ($stmt->get_result() as $row) {
      $return[] = $row['link'];
    }

    return $return;
  }

  /**
   * Save a listing to the database (pending listings/not verified yet)
   *
   * @param Listing $listing
   * @param array $info Information about the listing (contact/documents) 
   */
  public function requestListing($listing, $info) {

  }

  /**
   * Save an account to the database after sign-up
   *
   * @param UserAccount $account
   */
  public function saveAccount($account) {
    $type = '';

    if ($account instanceof ClientAccount) {
      $type = 'Client';
    }
    elseif ($account instanceof LandlordAccount) {
      $type = 'Landlord';
      $this->saveOwnerInfo($account);
    }
    else {
      $type = 'Agent';
      $this->saveOwnerInfo($account);
    }

    $firstName = $account->getFirstName();
    $lastName = $account->getLastName();
    $userName = $account->getUsername();
    $password = $account->getPassword();
    $email = $account->getEmail();

    $query = "INSERT INTO users (firstName, lastName, username, password, email, accountType) VALUES (?,?,?,?,?,?)";
    $stmt = $this->databaseConnection->prepare($query);

    $stmt->bind_param("ssssss", $firstName, 
                               $lastName,
                               $userName,
                               $password,
                               $email,
                               $type);
    $result = $stmt->execute();
    $userId = $this->databaseConnection->insert_id;
    $stmt->close();
    return $userId;
  }

  /**
   * Save an account to the database after sign-up
   *
   * @param OwnerAccount $account
   */
  public function saveOwnerInfo($account) {
    $phoneNumber = $account->getPhoneNumber();
    $userId = $account->getUserId();

    $query = "INSERT INTO owners (userId, phoneNumber) VALUES (?,?)";
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("ds", $userId, $phoneNumber);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  /**
   * Save a collection/bookmark a user has created
   *
   * @param UserAccount $user
   * @param Collection $collection
   */
  public function saveCollection($user, $collection) {
    $name = $collection->getName();
    $ownerID = $user->getOwnerId();

    $query = "INSERT INTO collections (collectionName, ownerId) VALUES (?,?)";
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("sd", $name, $ownerId);
    $stmt->execute();
    $stmt->close();
  }

  /**
   * Save a report made on a listing
   *
   * @param Report $report
   */
  public function saveReport($report) {
    $userId = $report->getUserId();
    $listingId = $report->getListingId();
    $reason = $report->getReason();

    $query = "INSERT INTO reports (userId, listingId, reasonForReport) VALUES (?,?,?)";
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("dds", $userId, $listingId, $reason);
    $stmt->execute();
    $stmt->close();
  }

  /**
   * Save a group object created
   *
   * @param UserAccount $account
   */
  public function saveGroup($group) {
    $name = $group->getName();
    $description = $group->getDescription();
    $ownerId = $group->getGroupOwner()->getUserId();

    $query = "INSERT INTO groups (groupName, groupDescription, groupOwnerId) VALUES (?,?,?)";
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("ssd", $name, $description, $ownerId);
    $stmt->execute();
    $stmt->close();
  }

  /**
   * Get members of a group
   *
   * @param int $groupId
   * @return CLientAccount[]
   */
  public function getMembersFromGroupId($groupId) {
    $query = "SELECT * 
    FROM groupMembers
    LEFT JOIN users
    ON users.userId = groupMembers.memberId
    WHERE groupMembers.groupId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $groupId);
    $result = $stmt->execute();

    $return = [];
    foreach($stmt->get_result() as $row) {
      $member = ClientAccount::listConstructor($row);
      $member->setUserId($row['memberId']);

      $return[] = $member;
    }

    return $return;
  }

  /**
   * Get invited members to a group
   *
   * @param int $groupId
   * @return CLientAccount[]
   */
  public function getInvitedMembersFromGroupId($groupId) {
    $query = "SELECT * 
    FROM groupInvitations
    LEFT JOIN users
    ON users.userId = groupInvitations.invitedId
    WHERE groupInvitations.groupId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $groupId);
    $result = $stmt->execute();

    $return = [];
    foreach($stmt->get_result() as $row) {
      $member = ClientAccount::listConstructor($row);
      $member->setUserId($row['invitedId']);

      $return[] = $member;
    }

    return $return;
  }

  /**
   * Get a group object
   *
   * @param int $groupId
   * @return Group
   */
  public function getGroupFromGroupId($groupId) {
    $query = "SELECT * 
    FROM groups
    LEFT JOIN users
    ON users.userId = groups.groupOwnerId
    WHERE groups.groupId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $groupId);
    $result = $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();
    $owner = ClientAccount::listConstructor($row);
    $owner->setUserId($row['groupOwnerId']);

    $invited = $this->getInvitedMembersFromGroupId($groupId);
    $members = $this->getMembersFromGroupId($groupId);

    $group = new Group($members, $invited, $owner, $row['groupName'], $row['groupDescription']);
    $group->setGroupId($groupId);

    return $group;
  }

  /**
   * Remove a group from the table
   *
   * @param int $groupId
   */
  public function removeGroup($groupId) {
    $this->removeAllInvitesFromGroup($groupId);
    $this->removeAllUsersFromGroup($groupId);

    $query = "DELETE FROM groups 
    WHERE groupId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $groupId);
    $result = $stmt->execute();
  }

  /**
   * Invite a user to a group
   *
   * @param int $groupId
   * @param int $inviter Invider userId
   * @param int $userId The user getting invited
   */
  public function inviteUserToGroup($groupId, $inviter, $userId) {
    $query = "INSERT INTO groupInvitations
    VALUES (?, ?, ?)";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("ddd", $groupId, $userId, $inviter);
    $result = $stmt->execute();
  }

  /**
   * Uninvite a user from a group
   *
   * @param int $groupId
   * @param int $userId The user getting invited
   */
  public function removeInviteFromGroup($groupId, $userId) {
    $query = "DELETE FROM groupInvitations
    WHERE groupId=? AND invitedId=?";

    $stmt = $this->databaseConnection->prepare($query);

    if (!$stmt) {
      echo $this->databaseConnection->error;
    }
    $stmt->bind_param("dd", $groupId, $userId);
    $result = $stmt->execute();
  }

  /**
   * Uninvite all users from a group
   *
   * @param int $groupId
   */
  public function removeAllInvitesFromGroup($groupId) {
    $query = "DELETE FROM groupInvitations
    WHERE groupId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $groupId);
    $result = $stmt->execute();
  }

  /**
   * Add a user to a group and remove the invitation
   *
   * @param int $groupId
   * @param int $userId The user getting added
   */
  public function addUserToGroup($groupId, $userId) {
    // Remove the invitation in order to accept
    $this->removeInviteFromGroup($groupId, $userId);

    $query = "INSERT INTO groupMembers
    VALUES (?, ?)";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("dd", $groupId, $userId);
    $result = $stmt->execute();
  }

  /**
   * Remove a user from a group
   *
   * @param int $groupId
   * @param int $userId The user getting removed
   */
  public function removeUserFromGroup($groupId, $userId) {
    $query = "DELETE FROM groupMembers 
    WHERE groupId=? AND memberId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("dd", $groupId, $userId);
    $result = $stmt->execute();
  }

  /**
   * Remove all users from a group
   *
   * @param int $groupId
   */
  public function removeAllUsersFromGroup($groupId) {
    $query = "DELETE FROM groupMembers 
    WHERE groupId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("d", $groupId);
    $result = $stmt->execute();
  }

  /**
   * Save a verification code created after a forgot password request
   *
   * @param string $username The account the verification is associated with
   * @param string $code
   */
  public function saveVerificationCode($username, $code) {

  }

  /**
   * Check if the latest verification code matches the one given
   *
   * @param string $username The account the verification is associated with
   * @param string $code
   * @return boolean True if the code matches
   */
  public function checkVerificationCode($username, $code) {

  }

  /**
   * Get the session information for a user
   *
   * @param string $userId
   * @return array
   */
  public function getSessionDataFromUserId($userId) {
    $this->removeExipredSessions();

    $query = "SELECT * 
    FROM sessions 
    WHERE userId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $userId);
    $result = $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();

    if (!isset($row)) {
      return null;
    }
    else {
      $this->removeSessionFromUserId($userId);
      $row['sessionId'] = $this->setSessionDataWithUserId($userId);
      return $row;
    }
  }

  /**
   * Get the username for a session
   *
   * @param string $sessionId
   * @return array
   */
  public function getUserInfoFromSessionId($sessionId) {
    $this->removeExipredSessions();

    $query = "SELECT * 
    FROM sessions
    LEFT JOIN users
    ON users.userId=sessions.userId
    WHERE sessions.sessionId=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $sessionId);
    $result = $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();

    if (!isset($row)) {
      return null;
    }
    else {
      return $row;
    }
  }

  /**
   * Set a new session for a user
   *
   * @param string $userId
   * @return string SessionId
   */
  public function setSessionDataWithUserId($userId) {
    $query = "INSERT INTO sessions (userId, sessionId, expires)
    VALUES (?, UUID(), NOW() + INTERVAL 2 HOUR)";
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $userId);
    $result = $stmt->execute();

    $query = "SELECT sessionId FROM sessions WHERE userId=?";
    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $userId);
    $result = $stmt->execute();

    $row = $stmt->get_result()->fetch_assoc();
    return $row['sessionId'];
  }

  /**
   * Removes expired sessions from the database
   */
  public function removeExipredSessions() {
    $query = "DELETE FROM sessions
    WHERE expires < NOW()";

    $stmt = $this->databaseConnection->prepare($query);
    $result = $stmt->execute();
  }

  /**
   * Removes a session for a user
   * @param int $userID
   */
  public function removeSessionFromUserId($userId) {
    $query = "DELETE FROM sessions
    WHERE userId = ?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $userId);
    $result = $stmt->execute();
  }

  /**
   * Removes a session for a user
   * @param string $sessionId
   */
  public function removeSessionFromSessionId($sessionID) {
    $query = "DELETE FROM sessions
    WHERE sessionID = ?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("s", $sessionID);
    $result = $stmt->execute();
  }

  /**
   * Updates teh password for a user
   * @param string $username
   */
  public function changePasswordFromUsername($username, $password) {
    $query = "UPDATE users
    SET password = ?
    WHERE username=?";

    $stmt = $this->databaseConnection->prepare($query);
    $stmt->bind_param("ss", $password, $username);
    $result = $stmt->execute();
  }
}
?>