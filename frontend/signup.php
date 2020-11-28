<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!--Google API Icons-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        
        <script src="js/scripts.js"></script>
        <script src="js/signupScripts.js"></script>

        <title>Tri-lo</title>
        <style>
            body {
                background-color: #363232;
                background-image: url(https://rpiathletics.com/images/2020/6/30/Campus.jpg?width=1920&quality=80&format=jpg);
            }
            /* Remove the navbar's default margin-bottom and rounded borders */ 
            .navbar {
                position:relative;
                background-color: #222222;
            }
            .card {
                position: relative;
            }
            .active{
                background-color: black;
            }
            .container {
                position: absolute;
                text-align: center;
                color: white;
                top: 0%;
                left: 0%;
            }
            .centered {
                position: absolute;
                top: 10%;
                left: 50%;
                font-size: 28px;
                color: black;
            }
            .footer {
                position: relative;
                background-color: #555;
                color: white;
                bottom: 0%;
                width: 100%;
            }
        </style>
    </head>

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


    <body onload="setEventListeners();setSignupEventListeners();">
        <nav class="navbar navbar-expand fixed-top lg navbar-dark">
            <a class="navbar-brand" href="#">Tri-lo</a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto" id="home">
                  <li class="nav-item" >
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                </ul>
            </div>
            <div class="navbar-nav mr-auto active" id= "login">
                <a class="nav-link" href="#"><span class="material-icons" style="font-size: 1rem; transform: translate(0,10%);">login</span>Login <span class="sr-only">(current)</span></a>
            </div>
        </nav>
        <div class="card mb-3 col-auto centered" style="position: absolute; width: 28%; left:35%; margin-top: 5%; padding-left: 2%; padding-right: 2%; padding-bottom: 1%;">
            <div class="font-weight-bold" style="text-align: center; font-size: 36px; padding: 8%">Sign up for Tri-Lo</div>
            <div class= "form-row align-items-center">
              <form action="signup.php" method="post">
                <label for="username">Username</label>
                <div style="width: 100%;">
                    <input type="text" class="form-control mb-2" id="username" name="username" placeholder="">
                </div>
                <div style="font-size: 12px; color: gray; width: 100%;" id="usernameReq">Must be between 4-12 characters long, no special characters allowed (:<>/%#&?')</div>
                <label for="email">Email Address</label>
                <div style="width: 100%;">
                    <input type="text" class="form-control mb-2" id="email" name="email" placeholder="user@email.com">
                </div>
                <div style="font-size: 12px; color: gray; width: 100%;" id="emailReq">Please enter a valid email address</div>
                <label for="password">Create new password</label>
                <div style="width: 100%;">
                    <input type="password" class="form-control mb-2" id="password" name="password" placeholder="">
                </div>
                <div style="font-size: 12px; color: gray; width: 100%;" id="passwordReq">Must be at least 8 characters, at least 1 number, 1 lowercase, 1 uppercase</div>
                <label for="cpassword">Confirm password</label>
                <div style="width: 100%;">
                    <input type="password" class="form-control mb-2" id="cpassword" name="cpassword" placeholder="">
                </div>
                <div style="font-size: 12px; color: gray; width: 100%;" id="cpasswordReq"> The two passwords must match</div>

                <!--https://www.geeksforgeeks.org/password-matching-using-javascript/ to be done later-->
                <input class="btn btn-light" style="width: 100%" id="signup" type="submit" value="Sign Up" name="signup"/>
                <a href="#" class="btn btn-link" style="width: 100%" id="login2">Go back to login page</a>
              </form> 
            </div>
            
        </div>
    </body>
</html>
