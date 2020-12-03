<?php
	require dirname(__FILE__) . '\..\vendor\autoload.php';

    function getUserInfo($sessionId){
        var_dump($sessionId);
        $manager = \app\database\DatabaseManager::getInstance();
        $result = $manager->getUserInfoFromSessionId($sessionId);
        
        return $result;
    }
?>