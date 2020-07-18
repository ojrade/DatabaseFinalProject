<?php
session_start();
include('connection.php'); 


$userid = intval($_SESSION['user_id']);
$sql = "SELECT m.title, f.rating FROM movies m, favorites f WHERE f.user_id='$userid' AND m.movie_id=f.movie_id";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) < 1){
        echo '<div class="alert alert-danger">No valid movies</div>';
    }else{
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $title=$row['title'];
            $rating=$row['rating'];

            echo "<div class='Movie'><div class='title'>$title</div><div class='info'><nobr><p style='margin-left:2.5em'>Year:$rating</p></nobr></div></div>";
        }
    }
}else{
    echo '<div class="alert alert-danger">SQL error has occured</div>';
}
?>