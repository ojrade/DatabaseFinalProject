<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
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
      <style>
        #container{
            margin-top:120px;   
        }

        .buttons{
            margin-bottom: 20px;   
        }

        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #CA3DD9;
            color: #CA3DD9;
            background-color: #FBEFFF;
            padding: 10px;
              
        }
        
          
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
          
        .timetext{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

      </style>
  </head>
  <body>
    <!--Navigation Bar-->  
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
                      <li><a href="mainpageloggedin.php">Home</a></li>
                    <li><a href="#">Contact us</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="profile.php"><b><?php echo $_SESSION['username']?></b></a></li>
                    <li><a href="index.php?logout=1">Log out</a></li>
                  </ul>
              
              </div>
          </div>
      
      </nav>
    
<!--Container-->
      <div class="container" id="container">
          <!--Alert Message-->
          <div id="alert" class="alert alert-danger collapse">
              <a class="close" data-dismiss="alert">
                &times;
              </a>
              <p id="alertContent"></p>
          
          </div>
          <div class="text-center">
              <div class="text-center">
                  <div class="buttons">
                      <button id="Search" type="button" class="btn btn-info btn-lg" data-target="#SearchModal" data-toggle="modal">Search</button>
                      
                      <button id="Watched" type="button" class="btn btn-info btn-lg" data-target="#WatchedModal" data-toggle="modal">Add Watched</button>
                      
                      <button id="Favorite" type="button" class="btn btn-info btn-lg" data-target="#FavoriteModal" data-toggle="modal">Add Favorite</button>
                  </div>
                  <div id="MovieList">
                  </div>
              </div>
          </div>
      </div>
      
      <form method="post" id="SearchForm">
        <div class="modal" id="SearchModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 id="myModalLabel" style="align:left">
                        Search
                      </h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <!--sign up error-->
                          <div id="SearchMessage">
                          </div>
                          <label for="genre" class="sr-only">Genre:</label>
                          <input class="form-control" id="genre" type="text" name="genre" placeholder="Genre">
                          
                          <label for="country" class="sr-only">Country:</label>
                          <input class="form-control" id="country" type="text" name="country" placeholder="Country of origin">
                          
                          <label for="actor" class="sr-only">actor:</label>
                          <input class="form-control" id="actor" type="text" name="actor" placeholder="Actor">
                          
                          <label for="director" class="sr-only">Director:</label>
                          <input class="form-control" id="director" type="text" name="director" placeholder="Director">
                      </div>
                      <p>ORDER BY</p>
                      <input type="radio" id="crit_rate" name="order" value="m.crit_rev" checked>
                      <label for="crit_rate">Critic Rating</label>
                      <input type="radio" id="aud_rat" name="order" value="m.aud_rev">
                      <label for="aud_rat">Audience Rating</label>
                      <input type="radio" id="year" name="order" value="m.year">
                      <label for="year">Year</label>
                      <input type="radio" id="alph" name="order" value="m.title">
                      <label for="alph">Alphabetical</label>
                      
                      <p>Ascending or descending?</p>
                      <input type="radio" id="DESC" name="ascdesc" value="DESC" checked>
                      <label for="DESC">Decreasing</label>
                      <input type="radio" id="ASC" name="ascdesc" value="ASC">
                      <label for="ASC">Increasing</label><br>
                      
                      <input type="checkbox" id="exWatched" name="exWatched" value="watch">
                      <label for="exWatched">Exclude Watched</label>
                  </div>
                  <div class="modal-footer">
                      <input id="search" class="btn green" name="signup" type="submit" value="Search" data-toggle="modal">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                      Cancel
                      </button>
                  </div>
              </div>
          </div>
      </div>
    </form>
      
    <form method="post" id="WatchedForm">
        <div class="modal" id="WatchedModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 id="myModalLabel" style="align:left">
                        Add Watched
                      </h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <!--sign up error-->
                          <div id="WatchedMessage">
                          </div>
                          <label for="watched" class="sr-only">Title:</label>
                          <input class="form-control" id="watched" type="text" name="watched" placeholder="Title">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input id="watch" class="btn green" name="signup" type="submit" value="Watch" data-toggle="modal">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                      Cancel
                      </button>
                  </div>
              </div>
          </div>
      </div>
    </form>
      
    <form method="post" id="FavoriteForm">
        <div class="modal" id="FavoriteModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 id="myModalLabel" style="align:left">
                        Add Favorite
                      </h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <!--sign up error-->
                          <div id="FavoriteMessage">
                          </div>
                          <label for="favorite" class="sr-only">Title:</label>
                          <input class="form-control" id="favorite" type="text" name="favorite" placeholder="Title">
                          
                          <label for="favRat" class="sr-only">Rating:</label>
                          <input class="form-control" id="favRat" type="text" name="favRat" placeholder="Rating">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <input id="favorites" class="btn green" name="signup" type="submit" value="Favorite">
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
    <script src="search.js"></script> 
  </body>
</html>