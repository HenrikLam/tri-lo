<?php

namespace tests\models;

use models\Collection;
use models\Listing;
use models\Location;
use models\LandlordAccount;

class CollectionTester extends \PHPUnit\Framework\TestCase {
	private function getUser() {
		$user = new LandlordAccount("Bob", "Duncan", "duncab", "Password12#", "duncab@rpi.edu");

		return $user;
	}

	private function getLocation() {
		$location = new Location("110 8th St.", null, "Troy", "NY", "12180");

		return $location;
	}

	private function getListing1() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		return $listing;
	}

	private function getListing2() {
		$listing = new Listing($this->getLocation(), 25000, $this->getUser(), true, "daily");

		return $listing;
	}

	private function getListing3() {
		$listing = new Listing($this->getLocation(), 100000, $this->getUser(), false, null);

		return $listing;
	}

	public function testConstructor() {
		$collection = new Collection("My Listings", $this->getUser);

		$expected = []
		$this->assertEquals($expected, $collection->getListings());
		$this->assertEquals($this->getUser()), $collection->getOwner());
		$this->assertEquals("My Listings", $collection->getListings());
	}

	public function testAddListing() {
		$collection = new Collection("My Listings", $this->getUser);

		$collection->testAddListing($this->getListing1());
		$collection->testAddListing($this->getListing2());
		$collection->testAddListing($this->getListing3());

		$expected = [
			$this->getListing1(), $this->getListing2(), $this->getListing3()
		];

		$this->assertEquals($expected, $collection->getListings());
	}

	public function testRemoveListing() {
		$collection = new Collection("My Listings", $this->getUser);

		$collection->testAddListing($this->getListing1());
		$collection->testAddListing($this->getListing2());
		$collection->testAddListing($this->getListing3());
		
		// Remove a listing by reference
		$collection->testRemoveListing($this->getListing3());

		// Remove a listing by index
		$collection->testRemoveListing(0);

		$expected = [
			$this->getListing2()
		];

		$this->assertEquals($expected, $collection->getListings());
	}

}