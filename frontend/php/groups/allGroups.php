<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  function makeArray($group) {
    return $group->toArray();
  }
  function alphaName($a, $b) {
    return strcmp($a->getName(), $b->getName());
  }

  $manager = \app\database\DatabaseManager::getInstance();

  // ONLY FOR GROUP OWNERS
  function inviteMember($group, $who) {
    global $manager;
    $manager->inviteUserToGroup($group->getGroupId(), $group->getGroupOwner()->getUserId(), $who);
  }

  // ONLY FOR GROUP OWNERS
  function deleteMember($group, $who) {
    global $manager;
    $manager->removeUserFromGroup($group->getGroupId(), $who);
  }

  // ONLY FOR CURRENT MEMBERS
  function leaveGroup($group, $who) {
    global $manager;
    deleteMember($group, $who);
  }

  // ONLY FOR GROUP OWNERS
  function deleteGroup($group, $who) {
    global $manager;
    $manager->removeGroup($group->getGroupId());
  }

  // ONLY FOR GROUP OWNERS
  function createGroup($group, $who) {
    global $manager;
    $manager->saveGroup($group);
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

    if ($command == 'createGroup') {
      $group = new \app\models\Group([], [], $manager->getUserInfoFromUserId($_POST['userId']), $_POST['name'], $_POST['description']);
    }
    $who = $_POST['userId'];

    // call command with proper "who" field
    $command($group, $who);
  }

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
    'userId' => $userInfo['userId']
  ];

  echo json_encode($return);
      
?>
      
