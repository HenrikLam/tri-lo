<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  function makeArray($group) {
    return $group->toArray();
  }
  function alphaName($a, $b) {
    return strcmp($a->getName(), $b->getName());
  }

  $manager = \app\database\DatabaseManager::getInstance();

  // ONLY FOR INVITED MEMBERS
  function acceptInvite($group, $who) {
    global $manager;
    $manager->addUserToGroup($group->getGroupId(), $who);
  }

  // ONLY FOR INVITED MEMBERS
  function deleteInvite($group, $who) {
    global $manager;
    $manager->removeInviteFromGroup($group->getGroupId(), $who);
  }

  if (!isset($_COOKIE['sessionID'])){
    echo 'Error: no sessionId provided!';
    return;
  }

  // Check if we are performing a command
  if (isset($_POST['command'])) {
    // var_dump($_POST);
    $command = $_POST['command'];

    $group = $manager->getGroupFromGroupId($_POST['groupId']);
    $who = $_POST['userId'];

    // call command with proper "who" field
    $command($group, $who);
  }
  $userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);

  $groups = $manager->getInvitedGroupsFromUserId($userInfo['userId']);


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
    'numInvited' => count($groups),
    'invited' => $groups,
    'userId' => $userInfo['userId']
  ];

  echo json_encode($return);
      
?>
      
