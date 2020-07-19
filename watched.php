<?php
session_start();
include('connection.php'); 
//<!--Check user inputs-->
//    <!--Define error messages-->
 $missingTitle = '<p><strong>Please enter a movie!</strong></p>';
$invalidTitle = '<p><strong>Please enter a valid movie!</strong></p>';
$errors="";
//    <!--Get username, email, password, password2-->
//Get username
if(empty($_POST["watched"])){
    $errors .= $missingTitle;
}else{
    $title = filter_var($_POST["watched"], FILTER_SANITIZE_STRING);   
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


$sql = "SELECT * FROM watched WHERE movie_id='$movieid' AND user_id='$userid'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}

$sql = "INSERT INTO watched (`user_id`, `movie_id`) VALUES ('$userid', '$movieid')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
}else{
    echo "Added '$title' to watched";
}
?>