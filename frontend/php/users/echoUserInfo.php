<?php
    require dirname(__FILE__) . '\getUserInfo.php';

    if (isset($_POST['sessionID'])){
        $result = getUserInfo($_POST['sessionID']);
        echo $result['userId'].';'.$result['firstName'].' '.$result['lastName'].';'.$result['username'].';'.$result['email'];
    } else {
        echo 'No sessionID provided!';
    }
?>