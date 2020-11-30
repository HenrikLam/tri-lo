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
  /** @var string */
  private $name;
  /** @var string */
  private $description;

  public function __construct($members, $invited, $owner, $name, $description) {
    $this->members = $members;
    $this->invited = $invited;
    $this->groupOwner = $owner;
    $this->name = $name;
    $this->description = $description;
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

  public function getName() {
    return $this->name;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setGroupId($groupId) {
    $this->groupId = $groupId;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setDescription($description) {
    $this->description = $description;
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