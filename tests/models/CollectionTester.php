<?php

namespace tests\models;

use app\models\Collection;
use app\models\Listing;
use app\models\Location;
use app\models\LandlordAccount;

class CollectionTester extends \PHPUnit\Framework\TestCase {

	/**
	 * Function used to create a new Landloard account for easier/neater code
	 */
	private function getUser() {
		$user = new LandlordAccount("Bob", "Duncan", "duncab", "Password12#", "duncab@rpi.edu");

		return $user;
	}

	/**
	 * Function used to create a new Location object for easier/neater code
	 */
	private function getLocation() {
		$location = new Location("110 8th St.", "Troy", "NY", "12180");

		return $location;
	}

	/**
	 * Function used to create a new Listing object for easier/neater code
	 * (rent = $1,200 per month)
	 */
	private function getListing1() {
		$listing = new Listing($this->getLocation(), 1200, $this->getUser(), true, "monthly");

		return $listing;
	}

	/**
	 * Function used to create a new Listing object for easier/neater code
	 * (rent = $25,000 per day)
	 */
	private function getListing2() {
		$listing = new Listing($this->getLocation(), 25000, $this->getUser(), true, "daily");

		return $listing;
	}

	/**
	 * Function used to create a new Listing object for easier/neater code
	 * (one time payment = $100,000)
	 */
	private function getListing3() {
		$listing = new Listing($this->getLocation(), 100000, $this->getUser(), false, null);

		return $listing;
	}

	/**
	 * Test to make sure that the Collection constructor works
	 * for collections with no Listings within them (empty listing array)
	 */
	public function testConstructor() {
		$collection = new Collection("My Listings", $this->getUser);

		$expected = []
		$this->assertEquals($expected, $collection->getListings());
		$this->assertEquals($this->getUser()), $collection->getOwner());
		$this->assertEquals("My Listings", $collection->getListings());
	}

	/**
	 * Construct a Collection object to add a new Listing and make sure
	 * that we can access it with the getter
	 */
	public function testAddListing() {
		$collection = new Collection("My Listings", $this->getUser);

		$collection->addListing($this->getListing1());
		$collection->addListing($this->getListing2());
		$collection->addListing($this->getListing3());

		$expected = [
			$this->getListing1(), $this->getListing2(), $this->getListing3()
		];

		$this->assertEquals($expected, $collection->getListings());
	}

	/**
	 * Construct a Collection object, add several Listings to the
	 * collection, and make sure that when we remove a listing, it
	 * gets removed properly
	 * -We should be able to remove a listing by reference or by index
	 */
	public function testRemoveListing() {
		$collection = new Collection("My Listings", $this->getUser);

		$collection->addListing($this->getListing1());
		$collection->addListing($this->getListing2());
		$collection->addListing($this->getListing3());
		
		// Remove a listing by reference
		$collection->removeListing($this->getListing3());

		// Remove a listing by index
		$collection->removeListing(0);

		$expected = [
			$this->getListing2()
		];

		$this->assertEquals($expected, $collection->getListings());
	}

}