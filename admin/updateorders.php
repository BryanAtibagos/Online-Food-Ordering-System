<?php
include 'db_conn.php';

if(isset($_POST['order_update']))
{
$ordered_product_id = $_POST['ordered_product_id'];
$order_status = $_POST['order_status'];

$query ="UPDATE ordered_product SET order_status = '$order_status'  WHERE ordered_product_id = '$ordered_product_id' ";
$query_run = mysqli_query($conn, $query);
 
if($query_run)
{
    echo '<script> alert("Data Updated"); </script>';
    header('Location: adminorders.php');
}
else
{
    echo '<script> alert("Data Not Updated"); </script>';
    header('Location: adminorders.php');
}
}
?>