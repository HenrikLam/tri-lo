<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  function makeArray($group) {
    return $group->toArray();
  }
  function alphaName($a, $b) {
    return strcmp($a->getName(), $b->getName());
  }

  if (!isset($_COOKIE['sessionID'])){
    echo 'Error: no sessionId provided!';
    return;
  }

  $manager = \app\database\DatabaseManager::getInstance();
  $userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);

  $groups = $manager->getGroupsFromUserId($userInfo['userId']);

  if (isset($_POST['sort'])) {
    if ($_POST['sort'] == 'alpha') {
      usort($groups, "alphaName");
    }
    else {
      usort($groups, "alphaName");
      $groups = array_reverse($groups);
    }
  }

  $groups = array_map('makeArray', $groups);

  $return = [
    'numGroups' => count($groups),
    'groups' => $groups,
  ];

  echo json_encode($return);
      
?>
      
