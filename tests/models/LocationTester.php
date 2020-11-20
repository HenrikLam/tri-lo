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
		$null_location = new Location(null);

		$this->assertEquals(null, $null_location->getAddressLine1());
		$this->assertEquals(null, $null_location->getAddressLine2());
		$this->assertEquals(null, $null_location->getCity());
		$this->assertEquals(null, $null_location->getState());
		$this->assertEquals(null, $null_location->getZipcode());
	}

	public function testFullListConstructor() {
		$addr_list = [
			"line1" => null,
			"line2" => null,
			"city" => "Troy",
			"state" => "NY",
			"zip" => "12180"
		];

		$full_location = new Location($addr_list);

		$this->assertEquals(null, $full_location->getAddressLine1());
		$this->assertEquals(null, $full_location->getAddressLine2());
		$this->assertEquals("Troy", $full_location->getCity());
		$this->assertEquals("NY", $full_location->getState());
		$this->assertEquals("12180", $full_location->getZipcode());
	}

	public function testHalfListConstructor() {
		$addr_list = [
			"city" => "Troy",
			"state" => "NY",
		];

		$half_location = new Location($addr_list);

		$this->assertEquals(null, $half_location->getAddressLine1());
		$this->assertEquals(null, $half_location->getAddressLine2());
		$this->assertEquals("Troy", $half_location->getCity());
		$this->assertEquals("NY", $half_location->getState());
		$this->assertEquals(null, $half_location->getZipcode());
	}

	public function testExtraListConstructor() {
		$addr_list = [
			"line1" => "123 14th St.",
			"line2" => null,
			"city" => "Troy",
			"state" => "NY",
			"zip" => null,
			"extra" => "ignore me",
			"blah" => "blah"
		];

		$extra_location = new Location($addr_list);	

		$this->assertEquals("123 14th St.", $extra_location->getAddressLine1());
		$this->assertEquals(null, $extra_location->getAddressLine2());
		$this->assertEquals("Troy", $extra_location->getCity());
		$this->assertEquals("NY", $extra_location->getState());
		$this->assertEquals(null, $extra_location->getZipcode());
	}

	public function testNullToArray() {
		$null_location = new Location(null);

		$expected = [
			"line1" => null,
			"line2" => null,
			"city" => null,
			"state" => null,
			"zip" => null
		];

		$this->assertEquals($expected, $null_location->toArray());
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