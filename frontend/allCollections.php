<?php

  require dirname(__FILE__) . '\..\vendor\autoload.php';

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

  $pageSize = 10;
  $numPages = count($collections) % $pageSize;
      
?>
      
