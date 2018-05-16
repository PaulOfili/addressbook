<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "fast";

// create a connection

$conn = mysqli_connect ( $server, $username, $password, $db);

//check connection

if(!$conn){
    die("Connection failed  " . mysqli_connect_error() );
}
//else{ 
//echo "Connected successfully <br>";
//}
?>