$("#SignUpForm").submit(function(event){
    //get form elements
    event.preventDefault();
    var userInfo = $(this).serializeArray();
    console.log(userInfo);
    //send to signup.php
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: userInfo,
        success: function(data){
            if(data){
                $("#SignUpMessage").html(data);
            }
        },
        error: function(){
            $("#SignUpMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});

$("#LoginForm").submit(function(event){
    //get form elements
    event.preventDefault();
    var userInfo = $(this).serializeArray();
    console.log(userInfo);
    //send to signup.php
    $.ajax({
        url: "login.php",
        type: "POST",
        data: userInfo,
        success: function(data){
            if(data == "success"){
                window.location="mainpageloggedin.php"
            }else{
                $('#LoginMessage').html(data);
            }
        },
        error: function(){
            $("#SignUpMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});