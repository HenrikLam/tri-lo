<?php

namespace tests\models;

use app\models\ClientAccount;


class GroupTester extends \PHPUnit\Framework\TestCase {
	private function getMember() {
		$member = new Member();

		return $member;
	}

	private function getInvited() {
		$invited = new invited();

		return $invited;
	}

	private function getGroupOwner() {
		$GroupOwner = new GroupOwner();

		return $GroupOwner;
	}

	private function getGroupId() {
		$id = new Id();

		return $id;
	}




	public function testAddMember() {
		$member = new Member("Bob", "Duncan", "duncab", "Password12#", "duncab@rpi.edu");

		$expected = [
			$this->getMember()
		];

		$this->assertEquals($expected, $expected->getMember());
	}

	public function testRemoveMember() {
		// Remove a listing by reference
		$collection->testRemoveMember($this->getMember());

		// Remove a listing by index
		$collection->testRemoveMember(0);

		$expected = [
			$this->getMember()
		];

		$this->assertEquals($expected, $member->getMember());
	}

}
