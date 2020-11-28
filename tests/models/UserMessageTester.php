<?php

namespace tests\models;

use models\ClientAccount;
use models\LandlordAccount;
use models\Message;


class UserMessageTester extends \PHPUnit\Framework\TestCase {

  
  private function getSender() {
		$sender = new ClientAccount("Bob", "Duncan", "duncab", "Password12#", "duncab@rpi.edu");

		return $sender;
  }
  
  private function getReceiver() {
		$receiver = new LandlordAccount("Shirley", "Ann", "AnnS", "Password12#", "AnnS@rpi.edu");

		return $receiver;
	}
	
  public function testMessageContent() {
    $message = new Messsage($this->)
    $timeStamp = new TimeStamp($this->getTimeStamp());

    return $timeStamp;
  }



}







