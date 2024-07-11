<?php

    /* First we establish a connection to the database, then we check if that connection was
    successful and if the connection failedd an error message is displayed and the script stops*/


    $conn = mysqli_connect("localhost","root","","ds_estate");

    if(!$conn){
        die("Connection Failed". mysqli_connect_error());
    }

?>