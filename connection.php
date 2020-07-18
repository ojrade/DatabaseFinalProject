<?php
$link = mysqli_connect("localhost", "ojrade", "Havefun1!", "final project");
if(mysqli_connect_error()){
    die('ERROR: Unable to connect:' . mysqli_connect_error()); 
    echo "<script>window.alert('Hi!')</script>";
}
    ?>