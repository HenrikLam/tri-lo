<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();
  
  function downloadAndGetPaths() {
    if ($_POST['type'] == 'listing') {
      $basePath = '..\..\..\images\listings\\' . $_POST['listingId'] . "\\";
      if (!is_dir($basePath)) {
        mkdir($basePath, 0777, true);
      }
      $links = [];

      for ($index = 0; $index < count($_FILES['files']['name']); $index++) {
        $fileName = $_FILES['files']['name'][$index];
        $path = $basePath . $fileName;
        $link = '..\images\listings\\' . $_POST['listingId'] . "\\" . $fileName;

        if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)){
          // echo($link);
        }

        array_push($links, $link);
      }

      return $links;
    }
    else {
      $basePath = '..\..\..\images\users\\' . $_POST['userId'] . "\\";
      if (!is_dir($basePath)) {
        mkdir($basePath, 0777, true);
      }
      $fileName = $_FILES['file']['name'];
      $path = $basePath . $fileName;

      $link = '..\images\users\\' . $_POST['userId'] . "\\" . $fileName;
      
      if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){
        echo($link);
      }
      return $link;
    }
  }

  // Download the images, and get the path into $images
  $paths = downloadAndGetPaths();

  // update database
  if ($_POST['type'] == 'listing') {
    $manager->uploadImagesFromListingId($_POST['listingId'], $paths);
  }
  else {
    $manager->uploadProfilePictureFromUserId(intval($_POST['userId']), $paths);
  }
      
?>
      
