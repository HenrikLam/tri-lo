<?php

namespace tests\models;

use app\models\LandlordAccount;

class ClientAccountTester extends \PHPUnit\Framework\TestCase {

  /**
   * Create a new ClientAccount and make sure the constructor
   * properly stores the information
   */
  public function testNormalConstructor() {
    $user = new ClientAccount("John", "Smith", "smithj", "321Password!", "smithj@rpi.edu");

    // assert correct values
    $this->assertEquals("John", $user->getFirstName());
    $this->assertEquals("Smith", $user->getLastName());
    $this->assertEquals("smithj", $user->getUsername());
    $this->assertEquals("321Password!", $user->getPassword());
    $this->assertEquals("smithj@rpi.edu", $user->getEmail());
  }

  /**
   * Test the ClientAccount list constructor with a null list
   * and make sure that every entry in the list is automatically
   * filled in with a null value 
   */
  public function testNullListConstructor() {
		$nullUser = new ClientAccount(null);

		// assert correct values
		$this->assertEquals(null, $user->getFirstName());
    $this->assertEquals(null, $user->getLastName());
    $this->assertEquals(null, $user->getUsername());
    $this->assertEquals(null, $user->getPassword());
    $this->assertEquals(null, $user->getEmail());
  }
  
  /**
   * Test the ClientAccount list constructor with an
   * associative array and make sure that every key refers 
   * to the variable we want to assign
   */
  public function testListConstructor() {
		$userList = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
			"email" => "smithj@rpi.edu"
		];

		$user = new ClientAccount($userList);

		// assert correct values
		$this->assertEquals("John", $user->getFirstName());
		$this->assertEquals("Smith", $user->getLastName());
		$this->assertEquals("smithj", $user->getUsername());
		$this->assertEquals("321Password!", $user->getPassword());
		$this->assertEquals("smithj@rpi.edu", $user->getEmail());
  }
  
  /**
   * Another test for the list constructor for the ClientAccount
   * where we make sure the list constructor only looks at keys 
   * that are referencing the variables we want to assign within
   * the constructor
   */
  public function testExtraListConstructor() {
		$userList = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
      "email" => "smithj@rpi.edu",
      "extra" => "ignore me", // ignore this entry in the constructor
      "blah" => "blah" // ignore this entry in the constructor
		];

		$extraUser = new ClientAccount($userList);

		// assert correct values
		$this->assertEquals("John", $extraUser->getFirstName());
		$this->assertEquals("Smith", $extraUser->getLastName());
		$this->assertEquals("smithj", $extraUser->getUsername());
		$this->assertEquals("321Password!", $extraUser->getPassword());
		$this->assertEquals("smithj@rpi.edu", $extraUser->getEmail());
  }
  
  /**
   * Test the toArray method with a ClientAccount with all null
   * information. We make sure the output has all null values
   * and the associative array is in the structure that the constructor
   * uses
   */
  public function testNullToArray() {
		$nullUser = new ClientAccount(null);

		$expected = [
			"firstName" => null,
			"lastName" => null,
			"username" => null,
			"password" => null,
			"email" => null
		];

		// assert correct values
		$this->assertEquals($expected, $nullUser->toArray());
	}

	/**
	 * Make sure that the setters of the ClientAccount object change
	 * each field correctly
	 */
  public function testSetters() {
		$user = new ClientAccount("John", "Smith", "smithj", "321Password!", "smithj@rpi.edu");

		$expected = [
			"firstName" => "John",
			"lastName" => "Smith",
			"username" => "smithj",
			"password" => "321Password!",
			"email" => "smithj@rpi.edu"
		];

		// Make sure the object is constructed
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

		// See reflected changes
		$this->assertEquals($expected, $user->toArray());
	}

}