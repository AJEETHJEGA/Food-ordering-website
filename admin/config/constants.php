<?php
    //start session
    session_start();

    $siteurl="http://localhost/Food%20ordering%20site/";
    $servername ="localhost";
    $username ="root";
    $password ="root";
    $dbame ="food-order";

    $conn = new mysqli($servername,$username,$password,$dbame);

    if($conn->connect_error){
        die("connection failed".$conn->connect_error);
    }
?>