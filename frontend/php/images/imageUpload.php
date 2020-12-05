<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();
  
  function downloadAndGetPaths() {
    if ($_POST['type'] == 'listing') {
      $basePath = dirname(__FILE__) . '\..\..\..\images\listings\\' . $_POST['listingId'] . "\\";
      $links = [];
      for ($index = 0; $index < $_FILES['files'].length(); $index++) {
        $fileName = $_FILES['files']['name'][$index];
        $path = $basePath . $fileName;

        if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)){
          $link = '..\images\listings\\' . $_POST['listingId'] . "\\" . $fileName;
          echo($link);
        }

        array_push($links, $link);
      }

      return $links;
    }
    else {
      $basePath = dirname(__FILE__) . '\..\..\..\images\users\\' . $_POST['userId'];
      if (!is_dir($basePath)) {
        mkdir($basePath);
      }
      $basePath = $basePath . "\\";
      $fileName = $_FILES['file']['name'];
      $path = $basePath . $fileName;

      $link = '..\images\users\\' . $_POST['userId'] . "\\" . $fileName;
      
      if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){
        $link = '..\images\users\\' . $_POST['userId'] . "\\" . $fileName;
        echo($link);
      }
      return $link;
    }
  }

  // Download the images, and get the path into $images
  $paths = downloadAndGetPaths();

  // update database
  if ($_POST['type'] == 'listing') {
    $manager->uploadImagesFromListingId($_POST['listingId'], $basePath);
  }
  else {
    $manager->uploadProfilePictureFromUserId(intval($_POST['userId']), $paths);
  }
      
?>
      
