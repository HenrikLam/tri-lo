<?php
    require dirname(__FILE__) . '\..\vendor\autoload.php';

    $manager = \app\database\DatabaseManager::getInstance();
    
    $address = "1141 E 229th St"; // Google HQ
    $apiKey = 'api-key'; // Google maps now requires an API key.
	// Get JSON results from this request
	$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
	$geo = json_decode($geo, true); // Convert the JSON to an array

	var_dump($geo);
	if (isset($geo['status']) && ($geo['status'] == 'OK')) {
	  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
	  $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
	}
    
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