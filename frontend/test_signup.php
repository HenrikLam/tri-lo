<?php
    $dbOk = false;
    
    @ $db = new mysqli('localhost', 'root', '', 'tri-lo');
      
      if ($db->connect_error) {
        echo '<div class="messages">Could not connect to the database. Error: ';
        echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
      } else {
        $dbOk = true; 
      }

      $havePost = isset($_POST["signup"]);
      
      $errors = '';
      if ($havePost) {

        if ($dbOk) {
          $username = trim($_POST["username"]);  
          $email = trim($_POST["email"]);
          $password = trim($_POST["password"]);

          $query = "select * from users where username = '";
          $query = $query.$username."'";
          $result = $db->query($query);
          $numRecords = $result->num_rows;
          if ($numRecords > 0) {
              echo "Username is already taken, please try another one";
          } else {
            $insQuery = "insert into users (`firstName`,`lastName`,`username`,`password`,`email`) values('first', 'last', ?,?,?)";
            $statement = $db->prepare($insQuery);
            $statement->bind_param("sss",$username,$password,$email);
            $statement->execute();
            $statement->close();

            //   redirect user to login page
            header("Location: login.html"); 
            exit();
          }
          
        }
        
      
      }

?>