<?php
$connection = mysqli_connect("localhost", "root","");
$db = mysqli_select_db($connection, 'heavens_plate');

if(isset($_POST['delete_categ']))
{
$category_id = $_POST['delete_id'];
$categ_status = $_POST['categ_status'];

$query ="UPDATE category SET categ_status = '0' WHERE category_id = '$category_id' ";
$query_run = mysqli_query($connection, $query);
 
if($query_run)
{
    echo '<script> alert("Data Deleted"); </script>';
    header('Location: admincategory.php');
}
else
{
    echo '<script> alert("Data Not Deleted"); </script>';
    header('Location: admincategory.php');
}
}
?>