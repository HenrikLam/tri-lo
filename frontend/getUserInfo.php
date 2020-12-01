<?php
    function getUserInfo($sessionId){
        require dirname(__FILE__) . '\..\vendor\autoload.php';
        $manager = \app\database\DatabaseManager::getInstance();

        if (isset($_POST['sessionID'])){
            $result = $manager->getUserInfoFromSessionId($_POST['sessionID']);
            return $result;
        }
        return NULL;
    }
?>