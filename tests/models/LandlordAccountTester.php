<?php

namespace tests\models;

use app\models\LandlordAccount;
use app\models\Location;
use app\models\Listing;
use app\models\Collection;

class LandlordAccountTester extends \PHPUnit\Framework\TestCase {
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

  private function getListing4() {
		$listing = new Listing($this->getLocation(), 2000, $this->getUser(), false, "monthly");

		return $listing;
  }
  
  private function getCurrentListings() {
    $collection = new Collection("Current Listings", $this->getUser, [$this->getListing1, $this->getListing2, $this->getListing3]);
    
		return $collection;
  }
  
  public function testNormalConstructor() {
    $user = new LandlordAccount("John", "Smith", "smithj", "321Password!", "smithj@rpi.edu", $this->getCurrentListings());
    $expected_current_listings = [$this->getListing1(), $this->getListing2(), $this->getListing3()];

    $this->assertEquals("John", $user->getFirstName());
    $this->assertEquals("Smith", $user->getLastName());
    $this->assertEquals("smithj", $user->getUsername());
    $this->assertEquals("321Password!", $user->getPassword());
    $this->assertEquals("smithj@rpi.edu", $user->getEmail());
    $this->assertEquals($expected_current_listings, $user->getCurrentListings());
  }

  public function testGetPrevListings() {
    $user = new AgentAccount("John", "Smith", "smithj", "321Password!", "smithj@rpi.edu", []);
    $expected_prev_listings = [$this->getListing4()];

    $this->assertEquals($expected_prev_listings, $user->getPrevListings());
  }

}