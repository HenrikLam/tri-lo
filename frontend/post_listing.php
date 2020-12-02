<?php

  require dirname(__FILE__) . '\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();
  
  // saveListing
  
  $error = false;
  $username = ''
  if (!isset($_POST['username'])){
      echo 'Error: no username provided!\n';
      $error = true;
  }
  if (!isset($_POST['listingName'])){
    echo 'Error: no listing name provided!\n';
    $error = true;
  }
  if (!isset($_POST['description'])){
    echo 'Error: no description provided!\n';
    $error = true;
  }
  if (!isset($_POST['rent'])){
    echo 'Error: no rent provided!\n';
    $error = true;
  }
  if (!isset($_POST['squareFeet'])){
    echo 'Error: no area (square feet) provided!\n';
    $error = true;
  }
  if (!isset($_POST['bedrooms'])){
    echo 'Error: no bedroom count provided!\n';
    $error = true;
  }
  if (!isset($_POST['bathroom'])){
    echo 'Error: no bathroom count provided!\n';
    $error = true;
  }
  if (!isset($_POST['leaseType'])){
    echo 'Error: no lease type provided!\n';
    $error = true;
  }
  if (!isset($_POST['status'])){
    echo 'Error: no status provided!\n';
    $error = true;
  }

  if (!$error) {
    // get user from username
    $owner = $manager->getUserInfoFromUsername($_POST['username']);

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

    var_dump($link);
    $geo = file_get_contents($link);
    $geo = json_decode($geo, true); // convert the JSON to an array

    // if the results are valid and is in the united states
    if (isset($geo) && isset($geo['data']) && isset($geo['data'][0]) && $geo['data'][0]['country_code'] == 'USA"') {
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
      "longitude" => $longitude;
      "latitude" => $latitude;
      "bedrooms" => $bedrooms,
      "bathrooms" => $bathrooms,
      "leaseType" => $leaseType,
      "dateTimePosted" => $dateTimePosted,
      "status" => $status
    ];
    
    $listing = \app\models\Listing::listConstructor($data);

    $manager->saveListing($owner, $listing)

  }

  // create location object
  // create listing object

  // create location and ownerAccount
  // get ownerId
  // get longitude latitude of location
  
      
?>
      
