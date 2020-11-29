<?php
    $dbOk = false;
    
    $db = mysqli_connect('localhost', 'root', '', 'tri-lo');
      
      if ($db->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
      } else {
        $dbOk = true; 
      }

      
      $errors = '';
      if ($db0k) {
          $firstname = "";
          if (isset($_POST['firstName'])) {
            $firstname = mysqli_real_escape_string($db, $_POST['firstName']);
          }
          $lastname = "";
          if (isset($_POST['lastName'])) {
            $lastname = mysqli_real_escape_string($db, $_POST['lastName']);
          }
          $username = "";
          if (isset($_POST['username'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
          }
          $email = "";
          if (isset($_POST['email'])) {
            $email = mysqli_real_escape_string($db, $_POST['email']);
          }
          $password = "";
          if (isset($_POST['password'])) {
            $password = mysqli_real_escape_string($db, $_POST['password']);
          }

          $query = "select * from users where username = '";
          $query = $query.$username."'";
          $result = $db->query($query);
          $numRecords = $result->num_rows;
          if ($numRecords > 0) {
              echo "Username is already taken, please try another one";
          } else {
            $insQuery = "insert into users (`firstName`,`lastName`,`username`,`password`,`email`) values('$firstname', '$lastname', $username, $email, $password)";
            $statement = $db->prepare($insQuery);
            $statement->bind_param("sss",$username,$password,$email);
            $statement->execute();
            $statement->close();

            //   redirect user to login page
            header("Location: login.html"); 
            exit();
          }
          
      }
        
      

?>