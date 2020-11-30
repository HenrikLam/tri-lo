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
        
        <script src="js/loginPageScripts.js"></script>
        <script src="js/scripts.js"></script>

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

      $havePost = isset($_POST["accLogIn"]);

      if ($havePost) {
        if ($dbOk) {
          $username = trim($_POST["username"]);  
          $password = trim($_POST["password"]);

          $query = "select * from users where username = '";
          $query = $query.$username."' and password = '";
          $query = $query.$password."' limit 1";

          $result = $db->query($query);
          $numRecords = $result->num_rows;

          if ($numRecords == 1) {
            $record = $result->fetch_assoc();
            setcookie("currentUsername", $record['username'], time()+86400);
            setcookie("currentUserId", $record['userId'], time()+86400);
            setcookie("currentFirstName", $record['firstName'], time()+86400);
            setcookie("currentLastName", $record['lastName'], time()+86400);
            // cookies for currently logged in user expire after one day

            header("Location: homepage.html"); 
            exit();
            
          }
          else {
            echo "Your username password combination is invalid, please try again";
          }


        }
      }
      
    ?>

    <body onload="setEventListeners(); setLoginEventListeners();">
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
            <div class="font-weight-bold" style="text-align: center; font-size: 36px; padding: 8%">Log in to Tri-Lo</div>
            <p style="color: red; font-size: 10pt; padding:0%;" id="alertBox"> </p>
            <div class="form-row align-items-center">
              <form action="login.php" method="post" class="form-row align-items-center">
                <label for="username">Username/Email Address</label>
                <div style="width: 100%;">
                    <input type="text" class="form-control mb-2" id="username" name="username" placeholder="">
                </div>
                <label for="password">Password</label>
                <div style="width: 100%;">
                    <input type="password" class="form-control mb-2" id="password" name="password" placeholder="">
                </div>
                
                <input class="btn btn-dark" style="width: 100%" id="accLogIn" type="submit" value="Log In" name="accLogIn"/>
                <a href="#" class="btn btn-light" style="width: 100%" id="signup">Sign up</a>
                <a href="#" class="btn btn-link" style="width: 100%">Forgot Password?</a>
              </form>
              </div>
        </div>
    </body>
</html>