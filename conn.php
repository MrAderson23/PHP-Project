<?php
    $host = "fdb1034.awardspace.net"; // ip / domain where mysql server run
    $user = "4435803_pika"; // mysql server valid username
    $pass = "LOL43337777"; // mysql user password
    $db   = "4435803_pika";
    // database to select
    define("DB_HOST", $host);
    define("DB_NAME", $db);
    define("DB_CHARSET", "utf8mb4");
    define("DB_USER", $user);
    define("DB_PASSWORD", $pass);
    
    //connection function using mysqli driver (3 drivers at least exist)
    //if connection fails print error and exit
    $conn = mysqli_connect($host, $user, $pass, $db) or die(mysqli_connect_error());
?>