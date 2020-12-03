<?php

  require dirname(__FILE__) . '\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();
  
  $error = false;
  if (!isset($_COOKIE['sessionID'])){
    echo 'Error: no sessionId provided!';
    $error = true;
  }
  if (!isset($_POST['listingName'])){
    echo 'Error: no listing name provided!';
    $error = true;
  }
  if (!isset($_POST['description'])){
    echo 'Error: no description provided!';
    $error = true;
  }
  if (!isset($_POST['rent'])){
    echo 'Error: no rent provided!\n';
    $error = true;
  }
  if (!isset($_POST['squareFeet'])){
    echo 'Error: no area (square feet) provided!';
    $error = true;
  }
  if (!isset($_POST['bedrooms'])){
    echo 'Error: no bedroom count provided!';
    $error = true;
  }
  if (!isset($_POST['bathrooms'])){
    echo 'Error: no bathroom count provided!';
    $error = true;
  }
  if (!isset($_POST['leaseType'])){
    echo 'Error: no lease type provided!';
    $error = true;
  }
  if (!isset($_POST['status'])){
    echo 'Error: no status provided!';
    $error = true;
  }

  if (!$error) {
    // get user from username
    $ownerInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);
    $owner = \app\models\UserAccount::listConstructor($ownerInfo);

    // make the Listing object
    $listingName = $_POST['listingName'];
    $description = $_POST['description'];
    $rent = $_POST['rent'];
    $squareFeet = $_POST['squareFeet'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $leaseType = $_POST['leaseType'];
    $status = $_POST['status'];

    // make new Location object
    $location = \app\models\Location::listConstructor($_POST);

    // get longitude/latitude
    $fullAddress = $location->getFullAddress();
    $address = urlencode($fullAddress);
    $apiKey = '3b8323bef47e78589a5fa98a2b7ab522'; // PositionStack API key.
	  // get JSON results from this request
    $link = "http://api.positionstack.com/v1/forward?access_key=" . $apiKey . "&query=" . $address . "&output=json";

    $geo = file_get_contents($link);
    $geo = json_decode($geo, true); // convert the JSON to an array

    // if the results are valid and is in the united states
    if (isset($geo) && isset($geo['data']) && isset($geo['data'][0]) && $geo['data'][0]['country_code'] == 'USA') {
      $latitude = $geo['data'][0]['latitude']; // Latitude
      $longitude = $geo['data'][0]['longitude']; // Longitude
    }
    else {
      echo "Error: We could not find this area. Please check your spelling or enter a valid ZIP code";
    }

    // get dateTimePosted
    date_default_timezone_set("America/New_York");
    $dateTimePosted = date("Y-m-d H:i:s");     

    $data = [
      "listingName" => $listingName,
      "location" => $location,
      "owner" => $owner,
      "description" => $description,
      "rent" => $rent,
      "squareFeet" => $squareFeet,
      "longitude" => $longitude,
      "latitude" => $latitude,
      "bedrooms" => $bedrooms,
      "bathrooms" => $bathrooms,
      "leaseType" => $leaseType,
      "dateTimePosted" => $dateTimePosted,
      "status" => $status
    ];

    $amenities = json_decode($_POST['amenities']);
    
    $listing = \app\models\Listing::listConstructor($data);
    $listing->setAmenities($amenities);

    $listingId = $manager->saveListing($listing);
    if ($listingId) {
      echo 'Listing added..';
    } 
    else {
      echo 'Error: ';
    }
  }
      
?>
      
