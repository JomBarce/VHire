<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="Vhire_Booking";

    $conn=mysqli_connect($host,$user,$password,$db);

    if(!$conn){
        die("Connection Failed".mysqli_connect_error());
    }

    session_start();

?>