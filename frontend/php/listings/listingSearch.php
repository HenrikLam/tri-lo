<?php
    require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

    function  makeArray($lis) {
        return $lis->toArray();
    }

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

    $filters = json_decode($_POST['amenities'], true); // explode this if necessary

    $sortBy = $_POST['sortType'] ?? 'sortnew';

    if ($sortBy == "sortnew") {
        $sortBy = "listings.listingId DESC";
    }
    elseif ($sortBy == "sortold") {
        $sortBy = "listings.listingId";
    }
    elseif ($sortBy == "sortplh") {
        $sortBy = "CAST(listings.rent AS INT)";
    }
    elseif ($sortBy == "sortphl") {
        $sortBy = "CAST(listings.rent AS INT) DESC";
    }
    elseif ($sortBy == "sortsqft") {
        $sortBy = "CAST(listings.squareFeet AS INT) DESC";
    }

    $manager = \app\database\DatabaseManager::getInstance();

    $listings = $manager->getListingsFromSearch($latitude,
                                      $longitude,
                                      $sortBy,
                                      $_POST['radius'] ?? 5,
                                      $filters);

    $count = count($listings);

    $pageNum = intval($_POST['pageNum']);
    $startOffset = ($pageNum - 1) * 10;
    $endOffset = min($startOffset + 10, count($listings));

    $listings = array_splice($listings, $startOffset, $endOffset);
    $listings = array_map('makeArray', $listings);

    $listings['pageCount'] = count($listings);
    $listings['numPages'] = ceil($count / 10.0);

    $return = json_encode($listings);

    echo $return;
?>