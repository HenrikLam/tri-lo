<?php
    function getUserInfo($sessionId){
        require dirname(__FILE__) . '\..\vendor\autoload.php';
        $manager = \app\database\DatabaseManager::getInstance();
        
        $result = $manager->getUserInfoFromSessionId($sessionId);
        return $result;
    }
?>