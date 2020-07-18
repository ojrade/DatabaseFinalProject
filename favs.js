$(document).ready(function() {
    //get form elements
    console.log("here");
    //send to signup.php
    $.ajax({
        url: "favorites.php",
        success: function(data){
            $('#MovieList').html(data);
        },
        error: function(){
            
        } 
    });
});