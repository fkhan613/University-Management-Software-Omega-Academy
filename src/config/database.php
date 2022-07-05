<?php
    //create constant variables for database connection
    define('DB_HOST', 'localhost');
    define('DB_USER', 'farhankhan');
    define('DB_PASS', 'farhan12345');
    define('DB_NAME', 'uni_managment_system');
    
    //create connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //check if connection is established
    if(!$conn){die('Connection failed: '.mysqli_connect_error());}
?>
<html><head><link rel="icon" type="image/png" href="../public/img/loginAvatar.svg"/></head></html> <!----Tab logo ------>