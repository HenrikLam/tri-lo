<?php

namespace tests\models;

use app\models\LandlordAccount;

class ClientAccountTester extends \PHPUnit\Framework\TestCase {

  public function testNormalConstructor() {
    $user = new ClientAccount("John", "Smith", "smithj", "321Password!", "smithj@rpi.edu");

    $this->assertEquals("John", $user->getFirstName());
    $this->assertEquals("Smith", $user->getLastName());
    $this->assertEquals("smithj", $user->getUsername());
    $this->assertEquals("321Password!", $user->getPassword());
    $this->assertEquals("smithj@rpi.edu", $user->getEmail());
  }

  public function testNullListConstructor() {
		$nullUser = new ClientAccount(null);

		$this->assertEquals(null, $user->getFirstName());
    $this->assertEquals(null, $user->getLastName());
    $this->assertEquals(null, $user->getUsername());
    $this->assertEquals(null, $user->getPassword());
    $this->assertEquals(null, $user->getEmail());
  }
  
  public function testListConstructor() {
		$userList = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
			"email" => "smithj@rpi.edu"
		];

		$user = new ClientAccount($userList);

		$this->assertEquals("John", $user->getFirstName());
		$this->assertEquals("Smith", $user->getLastName());
		$this->assertEquals("smithj", $user->getUsername());
		$this->assertEquals("321Password!", $user->getPassword());
		$this->assertEquals("smithj@rpi.edu", $user->getEmail());
  }
  
  public function testExtraListConstructor() {
		$userList = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
      "email" => "smithj@rpi.edu",
      "extra" => "ignore me",
      "blah" => "blah"
		];

		$extraUser = new ClientAccount($userList);

		$this->assertEquals("John", $extraUser->getFirstName());
		$this->assertEquals("Smith", $extraUser->getLastName());
		$this->assertEquals("smithj", $extraUser->getUsername());
		$this->assertEquals("321Password!", $extraUser->getPassword());
		$this->assertEquals("smithj@rpi.edu", $extraUser->getEmail());
  }
  
  public function testNullToArray() {
		$nullUser = new ClientAccount(null);

		$expected = [
			"firstName" => null,
			"lastName" => null,
			"username" => null,
			"password" => null,
			"email" => null
		];

		$this->assertEquals($expected, $nullUser->toArray());
	}

  public function testSetters() {
		$user = new ClientAccount("John", "Smith", "smithj", "321Password!", "smithj@rpi.edu");

		$expected = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
			"email" => "smithj@rpi.edu"
		];

		$this->assertEquals($expected, $user->toArray());

		$user->setFirstName("Joe");
		$user->setLastName("Schmoe");
		$user->setUsername("schmoj");
		$user->setPassword("NewPassword123");
		$user->setEmail("schmoj@rpi.edu");

		$expected = [
			"firstName" => "Joe",
			"lastName" => "Schmoe",
			"username" => "schmoj",
			"password" => "NewPassword123",
			"email" => "schmoj@rpi.edu"
		];

		$this->assertEquals($expected, $user->toArray());
	}

}