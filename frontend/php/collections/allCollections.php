<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  function makeArray($c) {
    return $c->toArray();
  }

  function alphaName($a, $b) {
    return strcmp($a->getName(), $b->getName());
  }

  function orderAdded($a, $b) {
    return $a->getCollectionId() - $b->getCollectionId();
  }


  if (!isset($_COOKIE['sessionID'])){
    echo 'Error: no sessionId provided!';
    return;
  }

  $manager = \app\database\DatabaseManager::getInstance();
  $userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);


  if (isset($_POST['command'])) {    
    $collectionId = $_POST['collectionId'];
    $listingId = $_POST['listingId'];

    if ($_POST['command'] == "remove") {
      $manager->removeListingFromCollection($collectionId, $listingId);
    }
  }
  

  $collections = [];
  if (isset($_POST['name'])) {
    // bookmarks searched
    $collections = $manager->getCollectionsFromName($userInfo['userId'], $_POST['name']);
  }
  else {
    // show all bookmarks
    $collections = $manager->getCollectionsFromUserId($userInfo['userId']);
  }

  if (isset($_POST['sort'])) {
    if ($_POST['sort'] == 'oldToNew') {
      usort($collections, "orderAdded");
    }
    elseif ($_POST['sort'] == 'newToOld') {
      usort($collections, "orderAdded");
      $collections = array_reverse($collections);
    }
    elseif ($_POST['sort'] == 'alpha') {
      usort($collections, "alphaName");
    }
    else {
      usort($collections, "alphaName");
      $collections = array_reverse($collections);
    }
  }

  $collections = array_map('makeArray', $collections);

  $return = [
    'numCollections' => count($collections),
    'collections' => $collections,
  ];

  echo json_encode($return);
      
?>
      
