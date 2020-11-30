

<title>PHP &amp; MySQL - ITWS</title>   

<h1>PHP &amp; MySQL</h1>
 
 PENIS

<?php

  include dirname(__FILE__) . '\app\database\DatabaseManager.php';
  include dirname(__FILE__) . '\app\models\Location.php';
  include dirname(__FILE__) . '\app\models\Listing.php';
  include dirname(__FILE__) . '\app\models\Collection.php';
  include dirname(__FILE__) . '\app\models\UserAccount.php';
  include dirname(__FILE__) . '\app\models\OwnerAccount.php';
  include dirname(__FILE__) . '\app\models\LandlordAccount.php';
  include dirname(__FILE__) . '\app\models\ClientAccount.php';
  include dirname(__FILE__) . '\app\models\Group.php';

  $manager = new \app\database\DatabaseManager(new mysqli('localhost', 'root', '', 'tri-lo'));

  // var_dump($manager->getCurrListingsFromUserId(1)[0]);

  // These give the same answer with 2 collections, "Nest" and "Test"
  // var_dump($manager->getCollectionsFromUserId(1));
  // var_dump($manager->getCollectionsFromName(1, "st")); //shows collection "Test"


  // var_dump($manager->checkLogIn("portoj", "Password123"));
  // var_dump($manager->checkLogIn("portoj", "Password1234"));

  // var_dump($manager->addUserToGroup(1, 1));
  // var_dump($manager->addUserToGroup(1, 2));
  // var_dump($manager->addUserToGroup(1, 3));
  // var_dump($manager->inviteUserToGroup(1, 1, 4));
  // var_dump($manager->getGroupFromGroupId(1));

  // var_dump($manager->getGroupsFromUserId(1));

?>

