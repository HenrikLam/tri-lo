<?php
    require dirname(__FILE__) . '\..\vendor\autoload.php';

    $address = "1141 E 229th St"; // Google HQ
    // $address = $_POST['address'];
    $address = urlencode($address);
    $apiKey = '3b8323bef47e78589a5fa98a2b7ab522'; // PositionStack API key.
	// Get JSON results from this request
    $link = "http://api.positionstack.com/v1/forward?access_key=" . $apiKey . "&query=" . $address . "&output=json";

    // var_dump($link);
	$geo = file_get_contents($link);
	$geo = json_decode($geo, true); // Convert the JSON to an array

    // if the results are valid and is in the united states
	if (isset($geo) && isset($geo['data']) && isset($geo['data'][0]) 
        && $geo['data'][0]['country_code'] == 'USA"') {
	  $latitude = $geo['data'][0]['location']; // Latitude
	  $longitude = $geo['data'][0]['location']; // Longitude
	}
    else {
        echo "We could not find this area. Please check your spelling or enter a valid ZIP code";
    }


    $filters = $_POST['amenities']; // explode this if necessary

    $manager = \app\database\DatabaseManager::getInstance();

    $listings = $manager->getListings($latitude,
                                      $longitude,
                                      /*$_POST['pageNum'], */
                                      $_POST['radius'] ?? 5,
                                      $filters)
    
    // $latitude = $output->results[0]->geometry->location->lat;
    // $longitude = $output->results[0]->geometry->location->lng;

    // $location = \app\models\Location($_POST);

    // if (is_set($location->getAddress()) && is_set($location->getCity()) && is_set($location->getState())) {
    // 	// Address with city and state (optional zipcode)
    // }
    // elseif (is_set($location->getCity()) && is_set($location->getState())) {
    // 	// Address with city and state
    // }
    // else {
    // 	echo "We could not find this area. Please check your spelling or enter a valid ZIP code"
    // }
    // if (isset($_POST['sessionID'])){
    //     $username = $manager->getUsernameFromSessionId($_POST['sessionID']);
    //     echo $username;
    // } else {
    //     echo 'No sessionID provided!';
    // }
?>