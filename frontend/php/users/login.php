<?php
    
    require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';

    $havePost = isset($_POST["accLogIn"]);

    $username = "";
    $password = "";

    $error = false;
    if (!isset($_POST['username'])){
        echo 'Error: no username provided!\n';
        $error = true;
    }
    if (!isset($_POST['password'])){
        echo 'Error: no password provided!\n';
        $error = true;
    }

    if (!$error){
        $manager = \app\database\DatabaseManager::getInstance();

        if ($manager->checkLogIn($_POST['username'], $_POST['password'])) {
            //make sessionID username pair
            //return sessionID to user to store as cookie
            
            $user = $manager->getUserInfoFromUsername($_POST['username']);
            $sessionId = $manager->setSessionDataWithUserId($user->getUserId());
            echo $sessionId;

            //cookie handled in loginPageScripts.js
        } else {
            echo 'Error: Credentials not matched to an account!';
        } 
    }
?>
