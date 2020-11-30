<?php
    $db = mysqli_connect('localhost', 'root', '', 'tri-lo');
    $connected = false;
    if ($db->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
    } else {
        $connected = true; 
    }

    if ($connected){
        $username = "";
        $password = "";

        $error = false;
        if (isset($_POST['username'])){
            $username = mysqli_real_escape_string($db, $_POST['username']);
        } else {
            echo 'Error: no username provided!\n';
            $error = true;
        }
        if (isset($_POST['password'])){
            $password = mysqli_real_escape_string($db, $_POST['password']);
        } else {
            echo 'Error: no password provided!\n';
            $password = true;
        }

        if (!$error){
            $query = "select * from users where username = '$username' and password = '$password'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                //make sessionID username pair
                //return sessionID to user to store as cookie
                // yeet
                echo 'user logged in!';
            } else if (mysqli_num_rows($result) == 0){
                echo 'Credentials not matched to an account!';
            } else {
                echo 'Error: '. mysqli_error($db);
            }
        }
    }
    $db -> close();
?>
