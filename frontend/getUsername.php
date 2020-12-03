<?php
    require dirname(__FILE__) . '\getUserInfo.php';

    if (isset($_POST['sessionID'])){
        echo getUserInfo($_POST['sessionID'])['username'];
    } else {
        echo 'No sessionID provided!';
    }
?>