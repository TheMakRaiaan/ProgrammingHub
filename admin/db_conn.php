<?php

 	//connect to database
    $conn = mysqli_connect('localhost', 'root', '', 'userdata');
 
    // check connection
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>
