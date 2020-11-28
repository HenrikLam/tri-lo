<?php

namespace tests\models;

use app\models\Location;

class LocationTester extends \PHPUnit\Framework\TestCase {

	/**
	 * Test the normal constructor for a Location
	 * -Check that all the getters reflect the expected contents
	 */
	public function testNormalConstructor() {
		$location = new Location(null, "Troy", "NY", null);

		// check expected values
		$this->assertEquals(null, $location->getAddress());
		$this->assertEquals("Troy", $location->getCity());
		$this->assertEquals("NY", $location->getState());
		$this->assertEquals(null, $location->getZipcode());
	}

	/**
	 * Test the null constructor for a Location
	 * We expect the list constructor to take place and create
	 * a listing with all fields that are empty (null)
	 */
	public function testNullListConstructor() {
		$nullLocation = new Location(null);

		// check expected values
		$this->assertEquals(null, $nullLocation->getAddress());
		$this->assertEquals(null, $nullLocation->getCity());
		$this->assertEquals(null, $nullLocation->getState());
		$this->assertEquals(null, $nullLocation->getZipcode());
	}

	/**
	 * Test the list constructor for a location
	 * each field will be an entry on the assosiative array
	 * and reflects a section of the address
	 */
	public function testFullListConstructor() {
		$addrList = [
			"address" => null,
			"city" => "Troy",
			"state" => "NY",
			"zip" => "12180"
		];

		$fullLocation = new Location($addrList);

		// check expected values
		$this->assertEquals(null, $fullLocation->getAddress());
		$this->assertEquals("Troy", $fullLocation->getCity());
		$this->assertEquals("NY", $fullLocation->getState());
		$this->assertEquals("12180", $fullLocation->getZipcode());
	}

	/**
	 * Test the list constructor for a locations that
	 * dont have every field filled in. Much like the null constructor,
	 * we expect any emoty fields to be filled in with null values
	 */
	public function testHalfListConstructor() {
		$addrList = [
			"city" => "Troy",
			"state" => "NY",
		];

		$halfLocation = new Location($addrList);

		// check expected values
		$this->assertEquals(null, $halfLocation->getAddress());
		$this->assertEquals("Troy", $halfLocation->getCity());
		$this->assertEquals("NY", $halfLocation->getState());
		$this->assertEquals(null, $halfLocation->getZipcode());
	}

	/**
	 * Test the list constructor for a arrays with extra entries.
	 * We expect the constructor to only look at entries that have to 
	 * do with the address, so all other keys will be ignored
	 */
	public function testExtraListConstructor() {
		$addrList = [
			"address" => "123 14th St.",
			"city" => "Troy",
			"state" => "NY",
			"zip" => null,
			"extra" => "ignore me", //extra
			"blah" => "blah" //extra
		];

		$extraLocation = new Location($addrList);	

		// check expected values
		$this->assertEquals("123 14th St.", $extraLocation->getAddress());
		$this->assertEquals("Troy", $extraLocation->getCity());
		$this->assertEquals("NY", $extraLocation->getState());
		$this->assertEquals(null, $extraLocation->getZipcode());
	}

	/**
	 * We want addresses to be able to turn their contents into an
	 * array for easy access and readability. It should be in the same 
	 * format that the list constructor expects
	 */
	public function testNullToArray() {
		$nullLocation = new Location(null);

		$expected = [
			"address" => null,
			"city" => null,
			"state" => null,
			"zip" => null
		];

		// check expected values
		$this->assertEquals($expected, $nullLocation->toArray());
	}

	/**
	 * Make sure that the setters of the Location object change
	 * each field correctly
	 */
	public function testSetters() {
		$location = new Location("110 8th St.", "Troy", "NY", "12180");

		$expected = [
			"address" => "110 8th St.",
			"city" => "Troy",
			"state" => "NY",
			"zip" => "12180"
		];

		// Make sure we constructed the Location properly
		$this->assertEquals($expected, $location->toArray());

		$location->setAddress("123 1st St. Apt. A2");
		$location->setCity("Brooklyn");
		$location->setState("NY");
		$location->setZipcode("11111");

		$expected = [
			"address" => "123 1st St. Apt. A2",
			"city" => "Brooklyn",
			"state" => "NY",
			"zip" => "11111"
		];

		// check expected values reflect the new set address information
		$this->assertEquals($expected, $location->toArray());
	}
}

?>