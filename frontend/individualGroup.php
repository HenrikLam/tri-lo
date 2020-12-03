<?php

  require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();

  // ONLY FOR GROUP OWNERS
  function inviteMember($group, $who) use ($manager) {
    $manager->inviteUserToGroup($group->getGroupId(), $group->getGroupOwner()->getUserId(), $who);
  }

  // ONLY FOR INVITED MEMBERS
  function acceptInvite($group, $who) use ($manager) {
    $manager->addUserToGroup($group->getGroupId(), $who);
  }

  // ONLY FOR GROUP OWNERS
  function unInvite($group, $who) use ($manager) {
    $manager->removeInviteFromGroup($group->getGroupId(), $who);
  }

  // ONLY FOR INVITED MEMBERS
  function deleteInvite($group, $who) use ($manager) {
    unInvite($group, $who);
    //redirect to "All Groups" page
  }

  // ONLY FOR GROUP OWNERS
  function deleteMember($group, $who) use ($manager) {
    $manager->removeUserFromGroup($group->getGroupId(), $who);
  }

  // ONLY FOR CURRENT MEMBERS
  function leaveGroup($group, $who) use ($manager) {
    deleteMember($group, $who);
    //redirect to "All Groups" page
  }

  // ONLY FOR GROUP OWNERS
  function deleteGroup($group, $who) use ($manager) {
    $manager->removeGroup($group->getGroupId());
    //redirect to "All Groups" page
  }

  if (!isset($_COOKIE['sessionID'])){
    echo 'Error: no sessionId provided!';
    return;
  }
  if (!isset($_POST['groupId'])){
    echo 'Error: no sessionId provided!';
    return;
  }

  $userInfo = $manager->getUserInfoFromSessionId($_COOKIE['sessionID']);
  $user = \app\models\UserAccount::listConstructer($userInfo);

  $group = $manager->getGroupFromGroupId($_POST['groupId']);

  // PERMISSION CHECK: is $user in $group
  if (!$manager->doesUserExistInGroup()) {
    echo 'Error: bad permissions!';
    return;
  }

  // Check if we are performing a command
  if (isset($_POST['command'])) {
    $command = $_POST['command'];

    // assume user is performing a command on themselves
    $who = $user->getUserId(); 
    if (isset($_POST['who'])) {
      // override $who if the command effects another user
      $who = $_POST['who'];
    }

    // call command with proper "who" field
    $command($group, $who);
  }


  // Show the groups after the command (if there was any)

  // Idk how yall wanna show these to the user
  $invited = $group->getInvited();
  $members = $group->getMembers(); 

  


  
      
?>
      
