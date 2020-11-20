<?php

namespace tests\models;

use models\UserAccount;


class UserMessageTester extends \PHPUnit\Framework\TestCase {

  
  public function getSender() {
		$sender = new User("Bob", "Duncan", "duncab", "Password12#", "duncab@rpi.edu");

		return $sender;
  }
  
  public function getReceiver() {
		$receiver = new Receiver("Shirley", "Ann", "AnnS", "Password12#", "AnnS@rpi.edu");

		return $receiver;
	}

  public function getMessage() {
    $message = new Message("from", "to", "message", "timestamp");

    return $message;
  }
	
  public function getTimeStamp() {
    $timeStamp = new TimeStamp($this->getTimeStamp());

    return $timeStamp;
  }

  private function sendStats() {
    $status = new status();
    return $send;
  }


}







