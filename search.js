$("#SearchForm").submit(function(event){
    //get form elements
    event.preventDefault();
    var userInfo = $(this).serializeArray();
    console.log(userInfo);
    //send to signup.php
    $.ajax({
        url: "searching.php",
        type: "POST",
        data: userInfo,
        success: function(data){
            $('#MovieList').html(data);
        },
        error: function(){
            $("#SearchMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});

$("#WatchedForm").submit(function(event){
    //get form elements
    event.preventDefault();
    var userInfo = $(this).serializeArray();
    console.log(userInfo);
    //send to watched.php
    $.ajax({
        url: "watched.php",
        type: "POST",
        data: userInfo,
        success: function(data){
            $('#WatchedMessage').html(data);
        },
        error: function(){
            $("#WatchedMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});

$("#FavoriteForm").submit(function(event){
    event.preventDefault();
    var userInfo = $(this).serializeArray();
    console.log(userInfo);
    //sent to addFavorites.php
    $.ajax({
        url: "addFavorites.php",
        type: "POST",
        data: userInfo,
        success: function(data){
            $('#FavoriteMessage').html(data);
        },
        error: function(){
            $("#FavoriteMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
        }
    });
});

