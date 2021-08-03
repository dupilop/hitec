<?php 
 echo "Hello world";
 
    define("HOST","localhost");
    define("DBUSER","hitecnepal");
    define("DBPASS","87DZ3X2n8nssLYFJ");
    define("DB","hitecnepal");
    
    $link = mysqli_connect(HOST, DBUSER, DBPASS, DB, 3306);
 
    if($link){
        echo "connected";
    }else{
        echo "error";
    }
    
    mysqli_close($link);
?>