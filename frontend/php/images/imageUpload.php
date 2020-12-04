<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();
  
  function someFunctionCall($files) {
    // look at every file in $_FILES
  }

  // Check if the image upload is for listings or users
  $basePath = '../images/users/' . $_POST['userId'];
  if (is_set($_POST['listingId'])) {
    $basePath = '../images/listings/' . $_POST['listingId'];
  }

  // Download the images, and get the path into $images
  $images = someFunctionCall();

  // update database
  if (is_set($_POST['listingId'])) {
    $manager->uploadImagesFromListingId($_POST['listingId'], $images);
  }
  else {
    $manager->uploadProfilePictureFromUserId($_POST['userId'], $images[0]);
  }
      
?>
      
