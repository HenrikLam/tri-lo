<?php

namespace tests\models;

use models\LandlordAccount;

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
		$null_user = new ClientAccount(null);

		$this->assertEquals(null, $user->getFirstName());
    $this->assertEquals(null, $user->getLastName());
    $this->assertEquals(null, $user->getUsername());
    $this->assertEquals(null, $user->getPassword());
    $this->assertEquals(null, $user->getEmail());
  }
  
  public function testListConstructor() {
		$user_list = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
			"email" => "smithj@rpi.edu"
		];

		$user = new ClientAccount($user_list);

		$this->assertEquals("John", $user->getFirstName());
		$this->assertEquals("Smith", $user->getLastName());
		$this->assertEquals("smithj", $user->getUsername());
		$this->assertEquals("321Password!", $user->getPassword());
		$this->assertEquals("smithj@rpi.edu", $user->getEmail());
  }
  
  public function testExtraListConstructor() {
		$user_list = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
      "email" => "smithj@rpi.edu",
      "extra" => "ignore me",
      "blah" => "blah"
		];

		$extra_user = new ClientAccount($user_list);

		$this->assertEquals("John", $extra_user->getFirstName());
		$this->assertEquals("Smith", $extra_user->getLastName());
		$this->assertEquals("smithj", $extra_user->getUsername());
		$this->assertEquals("321Password!", $extra_user->getPassword());
		$this->assertEquals("smithj@rpi.edu", $extra_user->getEmail());
  }
  
  public function testNullToArray() {
		$null_user = new ClientAccount(null);

		$expected = [
			"firstName" => null,
			"lastName" => null,
			"username" => null,
			"password" => null,
			"email" => null
		];

		$this->assertEquals($expected, $null_user->toArray());
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