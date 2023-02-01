<?php
$connection = mysqli_connect("localhost", "root","");
$db = mysqli_select_db($connection, 'heavens_plate');

if(isset($_POST['update_categ']))
{
$category_id = $_POST['category_id'];
$category_name = $_POST['category_name'];
$category_description = $_POST['category_description'];

$query ="UPDATE category SET category_name = '$category_name', category_description ='$category_description'  WHERE category_id = '$category_id' ";
$query_run = mysqli_query($connection, $query);
 
if($query_run)
{
    echo '<script> alert("Data Updated"); </script>';
    header('Location: test.php');
}
else
{
    echo '<script> alert("Data Not Updated"); </script>';
    header('Location: test.php');
}
}


?>