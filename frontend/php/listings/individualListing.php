<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();

/*
  function bookmarkListing($listing, $collectionId, $user) use ($manager) {
    $manager->saveListingToCollection($listing->getListingId(), $collectionId);
  }

  function reportListing($listing, $reason, $user) use ($manager) {
    $report = new \app\models\Report($user->getUserId(), $listing->getListingId(), $reason);
    $manager->saveReport($report);
  }

  function sendMessage($listing, $message, $user) use ($manager) {
    $message = new \app\models\Message($user, $listing->getOwner(), 'IDK', $message);
    $message->send();
  }
*/

  if (!isset($_POST['listingId'])){
    echo 'Error: no listingId provided!';
    return;
  }

  //$userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);
  //$user = \app\models\UserAccount::listConstructer($userInfo);

  $listing = $manager->getListingFromListingId($_POST['listingId']);

  // Check if we are performing a command
  if (isset($_POST['command']) && isset($_POST['param'])) {
    $command = $_POST['command'];
    $param1 = $_POST['param'];

    // Not logged in to perform commands
    if (!isset($_COOKIE['sessionID'])){
      // prompt them to log in?
      echo 'Error: no sessionId provided!';
      return;
    }

    $command($listing, $param, $user);

  }

  // var_dump($listing);
  $listing = $listing->toArray();
  $images = $manager->getImagesFromListingId($_POST['listingId']);
  $listing['images'] = $images;
  $listing['numImages'] = count($images);

  $listing = json_encode($listing);

  echo $listing;

  // Show the listing after command
  
      
?>
      
