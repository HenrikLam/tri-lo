<?php

namespace tests\models;

use app\models\Listing;
use app\models\Location;
use app\models\LandlordAccount;

class ListingTester extends \PHPUnit\Framework\TestCase {
	private function getUser() {
		$user = new LandlordAccount("Bob", "Duncan", "duncab", "Password12#", "duncab@rpi.edu");

		return $user;
	}

	private function getLocation() {
		$location = new Location("110 8th St.", null, "Troy", "NY", "12180");

		return $location;
	}

	public function testConstructor() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		$expected = [];
		$this->assertEquals($expected, $listing->getAmenities());
		$this->assertEquals($this->getLocation(), $listing->getLocation());
		$this->assertEquals($this->getUser(), $listing->getUser());
		$this->assertEquals(1200, $listing->getPrice()));
		$this->assertEquals("monthly", $listing->getPaymentFrequency());
	}

	public function testSetAmenities() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		$listing->setAmenities(["bathrooms" => 2, "bedrooms" => 3, "smoking" => "Yes"]);
		$expected = [
			"bathrooms" => 2,
			"bedrooms" => 3,
			"smoking" => "Yes";
		];
		$this->assertEquals($expected, $listing->getAmenities());
	}

	public function testAddAmenities() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		$listing->addAmenity("bathrooms", 2);
		$listing->addAmenity("bedrooms", 3);
		$listing->addAmenity("smoking", "Yes");
		$expected = [
			"bathrooms" => 2,
			"bedrooms" => 3,
			"smoking" => "Yes";
		];
		$this->assertEquals($expected, $listing->getAmenities());
	}

	public function testRemoveAmenities() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		$listing->addAmenity("bathrooms", 2);
		$listing->addAmenity("bedrooms", 3);
		$listing->addAmenity("smoking", "Yes");
		$listing->removeAmenity("smoking");
		$listing->removeAmenity("Pets Allowed");
		$expected = [
			"bathrooms" => 2,
			"bedrooms" => 3,
		];
		$this->assertEquals($expected, $listing->getAmenities());
	}

	public function testOverrideAmenities() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		$listing->addAmenity("bathrooms", 2);
		$listing->addAmenity("bedrooms", 3);
		$listing->addAmenity("smoking", "Yes");
		$listing->addAmenity("smoking", "No");
		$listing->addAmenity("bedrooms", 5);
		$expected = [
			"bathrooms" => 2,
			"bedrooms" => 5,
			"smoking" => "No";
		];
		$this->assertEquals($expected, $listing->getAmenities());
	}
}