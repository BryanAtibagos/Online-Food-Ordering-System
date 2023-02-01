<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'clinic');

    if(isset($_POST['updatedata']))
    {
        $product_id = strtoupper($_POST['product_id']);
        $cart_product_name = $_POST['cart_product_name'];



        $query = "UPDATE `course` 
                     SET `product_id`='$product_id',`cart_product_name`='$cart_product_name'
                   WHERE order_id='$order_id' ";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
            $_SESSION['status'] = "Record has been Updated";
            $_SESSION['status_code'] = "success";
            header('location: course.php');
        }
        else
        {
            $_SESSION['status'] = "Record Not Updated";
            $_SESSION['status_code'] = "error";
            header('location: course.php');
        }
    
    }