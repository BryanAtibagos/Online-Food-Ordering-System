<?php 
$conn = new mysqli("localhost","root" ,"","heavens_plate");
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
?>