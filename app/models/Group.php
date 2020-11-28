<?php

namespace app\models;

use app\models\ClientAccount;

class Group {

  /** @var string */
  private $members;
  /** @var string */
  private $invited;
  /** @var string */
  private $groupOwner;
  /** @var string */
  private $groupId;

  public function __construct($members, $invited, $owner) {
    $this->members = $members
    $this->invited = $invited;
    $this->groupOwner = $owner;
  }

  public function getMembers() {
    return $this->members;
  }

  public function getInvited() {
    return $this->invited;
  }

  public function getGroupOwner() {
    return $this->groupOwner;
  }

  public function getGroupId() {
    return $this->groupId;
  }

  public function setGroupId($group_id) {
    $this->group_id = $groupId;
  }

  public function inviteMember(\ClientAccount $user) {
    array_push($invited, $user);
    //$this->db_manager->inviteUserToGroup($group_id, $user);
  }

  public function addMember(\ClientAccount $user) {
    array_push($members, $user);
    //$this->db_manager->addUserToGroup($group_id, $user);
  }

}

?>