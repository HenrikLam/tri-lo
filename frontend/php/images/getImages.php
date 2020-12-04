<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';
  
  $manager = \app\database\DatabaseManager::getInstance();

  function user($id) {
    global $manager;
    $link = $manager->getImageFromUsername($id);

    if (!isset($link)) {
      $link = "sisman.png";
    }

    return $link;
  }

  function listing($id) {
    global $manager;
    return json_decode($manager->getImagesFromListingId($id));
  }

  // fetch image(s) for user or listing
  $imageType = $_POST['type'];

  // listing or userId
  $id = $_POST['id'];

  echo $imageType($id);
      
?>
      
