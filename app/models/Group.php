<?php

namespace app\models;

use app\models\ClientAccount;

class Group {

  /** @var string */
  private $members;
  /** @var string */
  private $invited;
  /** @var string */
  private $group_owner;
  /** @var string */
  private $group_id;

  public function __construct($members, $invited, $owner) {
    $this->members = $members
    $this->invited = $invited;
    $this->group_owner = $owner;
  }

  public function getMembers() {
    return $this->members;
  }

  public function getInvited() {
    return $this->invited;
  }

  public function getGroupOwner() {
    return $this->group_owner;
  }

  public function getGroupId() {
    return $this->group_id;
  }

  public function setGroupId($group_id) {
    $this->group_id = $group_id;
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