

<title>PHP &amp; MySQL - ITWS</title>   

<h1>PHP &amp; MySQL</h1>
 
<?php

  include dirname(__FILE__) . '\app\database\DatabaseManager.php';
  include dirname(__FILE__) . '\app\models\Location.php';
  include dirname(__FILE__) . '\app\models\Listing.php';
  include dirname(__FILE__) . '\app\models\Collection.php';
  include dirname(__FILE__) . '\app\models\UserAccount.php';
  include dirname(__FILE__) . '\app\models\OwnerAccount.php';
  include dirname(__FILE__) . '\app\models\LandlordAccount.php';

  $manager = new \app\database\DatabaseManager(new mysqli('localhost', 'root', '', 'tri-lo'));

  // var_dump($manager->getCurrListingsFromUserId(1)[0]);
  var_dump($manager->getCollectionsFromUserId(1)->getListings()[0]);
?>

