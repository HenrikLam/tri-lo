<?php
    require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

    var_dump($_POST);
    $address = $_POST['address'];
    $address = urlencode($address);
    $apiKey = '3b8323bef47e78589a5fa98a2b7ab522'; // PositionStack API key.
	// Get JSON results from this request
    $link = "http://api.positionstack.com/v1/forward?access_key=" . $apiKey . "&query=" . $address . "&output=json";

	$geo = file_get_contents($link);
	$geo = json_decode($geo, true); // Convert the JSON to an array

    // var_dump($geo['data'][0]);

    // if the results are valid and is in the united states
	if (isset($geo) && isset($geo['data']) && isset($geo['data'][0]) 
        && $geo['data'][0]['country_code'] == 'USA') {
	  $latitude = $geo['data'][0]['latitude']; // Latitude
	  $longitude = $geo['data'][0]['longitude']; // Longitude
	}
    else {
        echo "We could not find this area. Please check your spelling or enter a valid ZIP code";
        return;
    }


    $filters = [];//$_POST['amenities']; // explode this if necessary

    $manager = \app\database\DatabaseManager::getInstance();

    $listings = $manager->getListingsFromSearch($latitude,
                                      $longitude,
                                      /*$_POST['pageNum'], */
                                      $_POST['radius'] ?? 5,
                                      $filters);
    
    $return = json_encode($listings);

    $pageSize = 20;
    $numPages = count($listings) % $pageSize;

    echo $return;
?>