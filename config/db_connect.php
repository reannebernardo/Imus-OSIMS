<?php
    // set variables for know what user is currently logged in
    $user = 'test';
    // Connect to DB
    $conn = mysqli_connect('localhost', 'test', 'test1234', 'test-osims');

    // Check connection to DB
    if(!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }
    
?>