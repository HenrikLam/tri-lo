<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();

  function deleteCollection($collection, $which) use ($manager) {
    $manager->inviteUserToGroup($collection->getCollectionId(), $which);
  }

  // ONLY FOR INVITED MEMBERS
  function deleteListing($collection, $which) use ($manager) {
    $manager->deleteColelction($collection->getCollectionId());
  }

  if (!isset($_COOKIE['sessionID'])) {
    echo 'Error: no sessionId provided!';
    return;
  }
  if (!isset($_POST['collectionId'])) {
    echo 'Error: no sessionId provided!';
    return;
  }

  $userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);
  $user = \app\models\UserAccount::listConstructer($userInfo);

  $collection = $manager->getCollectionFromCollectionId($_POST['collectionId']);

  // PERMISSION CHECK: is $user->getUserId() == $collection->getOwnerId()
  if ($user->getUserId() != $collection->getOwnerId()) {
    echo 'Error: bad permissions!';
    return;
  }

  // Check if we are performing a command
  if (isset($_POST['command'])) {
    $command = $_POST['command'];

    $which = null; 
    if (isset($_POST['which'])) {
      // override $who if the command effects another user
      $which = $_POST['which'];
    }

    // call command with proper "who" field
    $command($collection, $who);
  }

  


  
      
?>
      
