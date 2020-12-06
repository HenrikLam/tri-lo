<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';
  
  $manager = \app\database\DatabaseManager::getInstance();

  // get userId, listingId
  $error = false;
  if (!isset($_POST['listingId'])){
    echo 'Error: no listingId provided!\n';
    $error = true;
  }
  if (!isset($_POST['reason'])){
    echo 'Error: no reason provided!\n';
    $error = true;
  }
  if (!isset($_COOKIE['sessionID'])){
    echo 'Error: no sessionId provided!\n';
    $error = true;
  }

  $userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);
  $userId = $userInfo['userId'];

  if (!$error) {
    $listingId = $_POST['listingId'];
    $reason = $_POST['reason'];

    $report = new \app\models\Report($userId, $listingId, $reason);
    $reportId = $manager->saveReport($report);

    echo $reportId;
  }
  
      
?>
      
