

<title>PHP &amp; MySQL - ITWS</title>   

<h1>PHP &amp; MySQL</h1>
 
 PENIS

<?php

  require dirname(__FILE__) . '\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();

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

  // var_dump($manager->getGroupsFromUserId(5));

  // $user = \app\models\UserAccount::listConstructor(['firstName' => 'h',
                                         // 'lastName' => 'h',
                                         // 'username' => 'h',
                                         // 'email' => 'h',
                                         // 'password' => 'h',
                                         // 'type' => 'Client']);

  // $user = $manager->getUserInfoFromUsername('poop');
  var_dump($manager->setSessionDataWithUserId(5));
  // var_dump($manager->saveAccount($user));



?>

