<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'heavens_plate');

if(isset($_POST['insertdata']))
{
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $query ="INSERT INTO category (category_id,category_name,category_description) VALUES ($category_id,$category_name,$category_description)";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo'<script> alert("Data Saved"); </script>';
    }else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}



?>