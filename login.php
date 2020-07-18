<?php
session_start();
include("connection.php");
$missingEmail = '<p> Please enter your email</p>';
$missingPassword = '<p> Please enter your password</p>';
$errors = "";

if(empty($_POST["loginEmail"])){
    $errors .= $missingEmail;   
}else{
    $email = filter_var($_POST["loginEmail"], FILTER_SANITIZE_EMAIL);
}

if(empty($_POST["loginPassword"])){
    $errors .= $missingPassword;   
}else{
    $password = filter_var($_POST["loginPassword"], FILTER_SANITIZE_STRING);
}

if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}else{
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    $sql = "SELECT * from users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) !== 1){
        echo '<div class="alert alert-danger">Wrong username or password</div>';
    }else{
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
        echo "success";
    }
}
?>