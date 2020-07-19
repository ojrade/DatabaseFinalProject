<?php
session_start();
include('connection.php');

//logout
include('logout.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movies</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <!--Navbar-->
    <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
      
          <div class="container-fluid">
            
              <div class="navbar-header">
              
                  <a class="navbar-brand">Movies</a>
                  <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  
                  </button>
              </div>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact us</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#LoginModal" data-toggle="modal">Login</a></li>
                  </ul>
              
              </div>
          </div>
      
      </nav>
    
<!--Jumbotron with signup-->
    <div class="jumbotron" id="myContainer">
        <h1>Movie Reccomendations</h1>
        <p>Get quick and fast search on a plethora of movies based on your own interests</p>
        
        <button type="button" class="btn btn-lg green signup" data-target="#SignUpModal" data-toggle="modal">
            Sign up
        </button>
    </div>
    
<!--Sign up form-->
    <form method="post" id="SignUpForm" autocomplete="off">
        <div class="modal" id="SignUpModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 id="myModalLabel" style="align:left">
                        Sign up now!
                      </h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <!--sign up error-->
                          <div id="SignUpMessage">
                          </div>
                          <label for="username" class="sr-only">Username:</label>
                          <input class="form-control" id="username" type="text" name="username" placeholder="Username">
                          
                          <label for="email" class="sr-only">Email:</label>
                          <input class="form-control" id="email" type="text" name="email" placeholder="Email Address">
                          
                          <label for="password" class="sr-only">Password:</label>
                          <input class="form-control" id="password" type="text" name="password" placeholder="Choose a Password">
                          
                          <label for="password2" class="sr-only">Confirm Password:</label>
                          <input class="form-control" id="password2" type="text" name="password2" placeholder="Confirm Password">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input class="btn green" name="signup" type="submit" value="Sign up">
                      <button type="button" class="btn btn-default" data-dismiss="modal" data-target="#LoginModal" data-toggle="modal">
                      Login
                      </button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                      Cancel
                      </button>
                  </div>
              </div>
          </div>
      </div>
    </form>

    <!--Login form-->
    <form method="post" id="LoginForm" autocomplete="off">
        <div class="modal" id="LoginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 id="myModalLabel" style="align:left">
                        Login
                      </h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <!--sign up error-->
                          <div id="LoginMessage"></div>
                          
                          <label for="loginEmail" class="sr-only">Email</label>
                          <input class="form-control" id="loginEmail" type="text" name="loginEmail" placeholder="Email">
                          
                          <label for="loginPassword" class="sr-only">Password</label>
                          <input class="form-control" id="loginPassword" type="text" name="loginPassword" placeholder="Password">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input class="btn green" name="login" type="submit" value="Login">
                      <button type="button" class="btn btn-default" data-dismiss="modal" data-target="#SignUpModal" data-toggle="modal">
                      Register
                      </button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                      Cancel
                      </button>
                  </div>
              </div>
          </div>
      </div>
    </form>
      
    <!-- Footer-->
      <div class="footer">
          <div class="container">
              <p></p>
          </div>
      </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="javascript.js"></script>
    <script src="index.js"></script>
  </body>
</html>