<?php

include 'db_conn.php';

    if(isset($_POST['update_ship']))
    {
    $customer_id = $_POST['customer_id'];
    $customer_firstname = $_POST['customer_firstname'];
    $customer_lastname = $_POST['customer_lastname'];
    $customer_number = $_POST['customer_number'];
    $customer_address = $_POST['customer_address'];
    
    $query ="UPDATE customer SET customer_id = '$customer_id', customer_firstname = '$customer_firstname', customer_lastname = '$customer_lastname', customer_number = '$customer_number', customer_address = '$customer_address'  WHERE customer_id = '$customer_id' ";
    $query_run = mysqli_query($conn, $query);
     
    if($query_run)
    {
        echo '<script> alert("Data Updated"); </script>';
        header('Location: checkout2.php');
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
        header('Location: checkout2.php');
    }
    }

?>