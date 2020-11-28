<?php

namespace tests\models;

use models\Listing;

class ReportTester extends \PHPUnit\Framework\TestCase {

  public function testNormalReport() {
    $user = new Report("0001", "11111", "111111", "Fraud Listing");

    $this->assertEquals("0001", $Listing->getUserId());
    $this->assertEquals("11111", $ListingId->getListingId());
    $this->assertEquals("111111", $reportID->getReportId());
    $this->assertEquals("Fraud Listing", $reason->getReason());
  }

  public function testNullReportConstructor() {
		$null_report = new Report(null);

		$this->assertEquals(null, $Listing->getUserId());
    $this->assertEquals(null, $ListingId->getListingId());
    $this->assertEquals(null, $reportID->getReportId());
    $this->assertEquals(null, $reason->getReason());

  }
  
  public function testListConstructor() {
		$user_report = [
			"userID" => "0001",
			"listingId" => "11111",
			"reportID" => "111111",
			"reasonForReporting" => "Fraud Listing"
		];

		$user = new testListConstructor($user_report);

		$this->assertEquals("userID", $user->getUserID());
		$this->assertEquals("listingId", $user->getListingID());
		$this->assertEquals("reportID", $user->getReportID());
		$this->assertEquals("reasonForReporting!", $user->getReason());
  }
  
  

  public function testSetters() {
		$user = new Report("0001", "11111", "11111", "Fraud Listing");

		$expected = [
			"userID" => "0001",
			"listingId" => "11111",
			"reportID" => "111111",
			"reasonForReporting" => "Fraud Listing"
		];

		$this->assertEquals($expected, $Report->toArray());

		$user->setUserID("0001");
		$user->setListingId("11111");
		$user->setReportID("111111");
	

		$expected = [
			"userID" => "0001",
			"listingId" => "11111",
			"reportID" => "111111",
			"reasonForReporting" => "Fraud Listing"
		];

		$this->assertEquals($expected, $Report->toArray());
	}

}