<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';
  
  $manager = \app\database\DatabaseManager::getInstance();

  function user($id) use ($manager) {
    return $manager->getImageFromUserId($id);
  }

  function listing($id) use ($manager) {
    return $manager->getImagesFromListingId($id);
  }

  // fetch image(s) for user or listing
  $imageType = $_POST['type'];

  // listing or userId
  $id = $_POST['type'];

  $return = $imageType($id);
      
?>
      
