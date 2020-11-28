<?php

namespace tests\models;

use app\models\Location;

class LocationTester extends \PHPUnit\Framework\TestCase {

	public function testNormalConstructor() {
		$location = new Location(null, null, "Troy", "NY", null);

		$this->assertEquals(null, $location->getAddressLine1());
		$this->assertEquals(null, $location->getAddressLine2());
		$this->assertEquals("Troy", $location->getCity());
		$this->assertEquals("NY", $location->getState());
		$this->assertEquals(null, $location->getZipcode());
	}

	public function testNullListConstructor() {
		$nullLocation = new Location(null);

		$this->assertEquals(null, $nullLocation->getAddressLine1());
		$this->assertEquals(null, $nullLocation->getAddressLine2());
		$this->assertEquals(null, $nullLocation->getCity());
		$this->assertEquals(null, $nullLocation->getState());
		$this->assertEquals(null, $nullLocation->getZipcode());
	}

	public function testFullListConstructor() {
		$addrList = [
			"line1" => null,
			"line2" => null,
			"city" => "Troy",
			"state" => "NY",
			"zip" => "12180"
		];

		$fullLocation = new Location($addrList);

		$this->assertEquals(null, $fullLocation->getAddressLine1());
		$this->assertEquals(null, $fullLocation->getAddressLine2());
		$this->assertEquals("Troy", $fullLocation->getCity());
		$this->assertEquals("NY", $fullLocation->getState());
		$this->assertEquals("12180", $fullLocation->getZipcode());
	}

	public function testHalfListConstructor() {
		$addrList = [
			"city" => "Troy",
			"state" => "NY",
		];

		$halfLocation = new Location($addrList);

		$this->assertEquals(null, $halfLocation->getAddressLine1());
		$this->assertEquals(null, $halfLocation->getAddressLine2());
		$this->assertEquals("Troy", $halfLocation->getCity());
		$this->assertEquals("NY", $halfLocation->getState());
		$this->assertEquals(null, $halfLocation->getZipcode());
	}

	public function testExtraListConstructor() {
		$addrList = [
			"line1" => "123 14th St.",
			"line2" => null,
			"city" => "Troy",
			"state" => "NY",
			"zip" => null,
			"extra" => "ignore me",
			"blah" => "blah"
		];

		$extraLocation = new Location($addrList);	

		$this->assertEquals("123 14th St.", $extraLocation->getAddressLine1());
		$this->assertEquals(null, $extraLocation->getAddressLine2());
		$this->assertEquals("Troy", $extraLocation->getCity());
		$this->assertEquals("NY", $extraLocation->getState());
		$this->assertEquals(null, $extraLocation->getZipcode());
	}

	public function testNullToArray() {
		$nullLocation = new Location(null);

		$expected = [
			"line1" => null,
			"line2" => null,
			"city" => null,
			"state" => null,
			"zip" => null
		];

		$this->assertEquals($expected, $nullLocation->toArray());
	}

	public function testSetters() {
		$location = new Location("110 8th St.", null, "Troy", "NY", "12180");

		$expected = [
			"line1" => "110 8th St.",
			"line2" => null,
			"city" => "Troy",
			"state" => "NY",
			"zip" => "12180"
		];

		$this->assertEquals($expected, $location->toArray());

		$location->setAddressLine1("123 1st St.");
		$location->setAddressLine2("Apt. A2");
		$location->setCity("Brooklyn");
		$location->setState("NY");
		$location->setZipcode("11111");

		$expected = [
			"line1" => "123 1st St.",
			"line2" => "Apt. A2",
			"city" => "Brooklyn",
			"state" => "NY",
			"zip" => "11111"
		];

		$this->assertEquals($expected, $location->toArray());
	}
}

?>