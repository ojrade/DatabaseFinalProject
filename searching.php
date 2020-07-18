<?php
session_start();
include("connection.php");
$errors = "";

$genre = filter_var($_POST["genre"], FILTER_SANITIZE_STRING);
$country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
$actor = filter_var($_POST["actor"], FILTER_SANITIZE_STRING);
$director = filter_var($_POST["director"], FILTER_SANITIZE_STRING);

if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}else{
    $genre = mysqli_real_escape_string($link, $genre);
    $country = mysqli_real_escape_string($link, $country);
    $actor = mysqli_real_escape_string($link, $actor);
    $director = mysqli_real_escape_string($link, $director);
    $sql = "SELECT m.title, m.year, m.crit_rev, m.aud_rev from movies m";
    if(!empty($genre) || !empty($country) || !empty($actor) || !empty($director)){
        if(!empty($genre)){
            $sql .= ", genre g, is_genre gi";
        }
        if(!empty($actor)){
            $sql .= ", actors a, acts_in ai";
        }
        
        if(!empty($director)){
            $sql .= ", directors d, directs di";
        }
        
        if(!empty($_POST['exWatched'])){
            $sql .= ", watched w";
        }
        $sql .= " WHERE";

        if(!empty($genre)){
            $sql .= " g.genre_id=gi.genre_id AND gi.movie_id=m.movie_id AND genre_name='$genre'";
        }
        if(!empty($actor)){
            if(!empty($genre)){
                $sql .= " AND";
            }
            $sql .= " a.actor_id=ai.actor_id AND ai.movie_id=m.movie_id AND actor_name='$actor'";
        }
        if(!empty($director)){
            if(!empty($genre) || !empty($actor)){
                $sql .= " AND";
            }
            $sql .= " d.director_id=di.director_id AND di.movie_id=m.movie_id AND director_name='$director'";
        }
        if(!empty($country)){
            if(!empty($genre) || !empty($actor) || !empty($director)){
                $sql .= " AND";
            }
            $sql .= " m.country='$country'";
        }
        
        if(!empty($_POST['exWatched'])){
            if(!empty($genre) || !empty($actor) || !empty($director) || !empty($country)){
                $sql .= " AND";
            }
            $sql .= " m.movie_id<>w.movie_id";
        }
    }
    if(isset($_POST['order'])){
        $ord=$_POST['order'];
        $sql .= " ORDER BY $ord";
    }
    if(isset($_POST['ascdesc'])){
        if($ord!="m.title"){
            $dir = $_POST['ascdesc'];
            $sql .= " $dir";
        }
    }
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) < 1){
            echo '<div class="alert alert-danger">No valid movies</div>';
        }else{
            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                $title=$row['title'];
                $year=$row['year'];
                $crit_rev=$row['crit_rev'];
                $aud_rev=$row['aud_rev'];
                
                echo "<div class='Movie'><div class='title'>$title</div><div class='info'><nobr><p style='margin-left:2.5em'>Year:$year</p><p style='margin-left:2.5em'>Average Critic Score:$crit_rev</p><p style='margin-left:2.5em'>Average Audience Score:$aud_rev</p></nobr></div></div>";
            }
        }
    }else{
        echo '<div class="alert alert-danger">SQL error has occured</div>';
    }
}
?>