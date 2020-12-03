<?php
    require dirname(__FILE__) . '\..\..\..\vendor\autoload.php';
    $manager = \app\database\DatabaseManager::getInstance();

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['newPassword'])){
        if ($manager->checkLogIn($_POST['username'], $_POST['password'])) {
            // credentials match, change the password
            $manager->changePasswordFromUsername($_POST['username'], $_POST['newPassword']);
            echo 'Password Changed';
        } else {
            echo $_POST['password'];
            echo 'Password Incorrect';
        }
    } else {
        echo 'Error: Missing Argument';
    }
?>