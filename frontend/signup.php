<?php

  require dirname(__FILE__) . '\..\vendor\autoload.php';

  $manager = \app\database\DatabaseManager::getInstance();
  
  // check to see if username is free
  if ($manager->getUserInfoFromUsername($_POST['username']) !== null) {
    echo "Username is already taken, please try another one";
  }
  else {
    $user = \app\models\UserAccount::listConstructor($_POST);

    if ($manager->saveAccount($user)) {
      echo 'User added..';
    } 
    else {
      echo 'Error: ';
    }
  }    
      
?>
      
