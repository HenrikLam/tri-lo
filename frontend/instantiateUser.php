<?php
    require dirname(__FILE__) . '\..\vendor\autoload.php';
    $manager = \app\database\DatabaseManager::getInstance();

    if (isset($_POST['sessionID'])){
        $username = $manager->getUsernameFromSessionId($_POST['sessionID']);
        echo $username;
    } else {
        echo 'No sessionID provided!';
    }
?>