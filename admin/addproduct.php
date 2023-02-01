<?php
session_start();
include 'db_conn.php';
if (isset($_SESSION['admin_firstname']) && isset($_SESSION['admin_lastname'])){
    $admin_id = $_SESSION['admin_id'];


$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'heavens_plate');

if(isset($_POST['insert_product']))
{
    
    $product_image = $_FILES["product_image"]["name"];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];

    if(file_exists("upload/" . $_FILES["product_image"]["name"]))
    {
        $store = $_FILES["product_image"]["name"];
        $_SESSION['status'] = "Image Already exists. '.$store.'";
        header('Location: adminproducts.php');
    }
    else{
            $query ="INSERT INTO product (`product_image`,`product_name`,`product_description`,`category_id`,`product_price`) VALUES ('$product_image','$product_name','$product_description','$category_id','$product_price')";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                move_uploaded_file($_FILES["product_image"]["tmp_name"], "upload/".$_FILES["product_image"]["name"]);
                $_SESSION['success'] ="Product Added";
                header('Location: adminproducts.php');
            }else
            {
                $_SESSION['success'] ="Product Not Added";
                header('Location: adminproducts.php');
            }
        }
    }





if(isset($_POST['insert_categ']))
{
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $query ="INSERT INTO category (`category_id`,`category_name`,`category_description`) VALUES ('$category_id','$category_name','$category_description')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: admincategory.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
        header('Location: admincategory.php');
    }
}



?>

<?php
}else{
    header("Location: loginadmin.php");
               exit();
}
?>