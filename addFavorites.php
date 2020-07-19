<?php
session_start();
include('connection.php');
//<!--Check user inputs-->
//    <!--Define error messages-->
$missingTitle = '<p><strong>Please enter a movie!</strong></p>';
$missingRating = '<p><strong>Please enter a rating! (0-100)</strong></p>';
$invalidRating = '<p><strong>Please enter a rating between 0 and 100</strong></p>';
$errors="";
//    <!--Get title and rating-->
//Get title
if(empty($_POST["favorite"])){
    $errors .= $missingTitle;
}else{
    $title = filter_var($_POST["favorite"], FILTER_SANITIZE_STRING);   
}

//Get title
if(empty($_POST["favRat"])){
    $errors .= $missingRating;
}else{
    if($_POST["favRat"]>100){
        $errors .= $invalidRating;
    }
    else{
        $rating = filter_var($_POST["favRat"], FILTER_SANITIZE_STRING);   
    }
}

//If there are any errors print error
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}

//no errors

//Prepare variables for the queries
$title = mysqli_real_escape_string($link, $title);
$userid = intval($_SESSION['user_id']);

$sql = "SELECT movie_id FROM movies WHERE title='$title'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if(mysqli_num_rows($result)<1){
    echo '<div class="alert alert-danger">Movie not found!</div>';
    exit;
}else{
    $movieid = intval($row['movie_id']);
}


$sql = "SELECT * FROM favorites WHERE movie_id='$movieid' AND user_id='$userid'";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result) !== 0){
    echo '<div class="alert alert-danger">Movie already in favorites!</div>';
    exit;
}

$sql = "CALL addfavorites('$userid','$movieid','$rating')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
} else{
    echo "Added '$title' to favorites";
}
?>