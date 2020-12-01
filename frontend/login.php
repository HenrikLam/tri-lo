<?php
    
    require dirname(__FILE__) . '\..\vendor\autoload.php';

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
        $password = true;
    }

    if (!$error){
        $manager = \app\database\DatabaseManager::getInstance();

        if ($manager->checkLogIn($_POST['username'], $_POST['password'])) {
            //make sessionID username pair
            //return sessionID to user to store as cookie
            // yeet
            echo '1';
        } else {
            echo 'Credentials not matched to an account!';
        } 
    }
?>
