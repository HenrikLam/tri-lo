<?php
    require dirname(__FILE__) . '\..\vendor\autoload.php';
    $manager = \app\database\DatabaseManager::getInstance();

    if (isset($_POST['sessionID'])){
        $manager->removeSessionFromSessionId($_POST['sessionID']);
        echo 'logged out';
    } else {
        echo 'No sessionID provided!';
    }
?>