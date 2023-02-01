<?php
include 'db_conn.php';

if(isset($_POST['product_update'])){
    $product_id = $_POST['product_id'];

    $product_name =$_POST['product_name'];
    $product_description =$_POST['product_description'];
    $category_id =$_POST['category_id'];
    $product_price =$_POST['product_price'];
    $top_selling =$_POST['top_selling'];

    $new_image = $_FILES['product_image']['name'];
    $old_image = $_POST['product_image_old'];

    if($new_image != '')
    {
        $update_filename = $_FILES['product_image']['name'];
    }
    else
    {
        $update_filename = $old_image;
    }



        if(file_exists("upload/".$_FILES['product_image']['name']))
            {
                $filename = $_FILES['product_image']['name'];
                $_SESSION['status'] = "Image already Exists".$filename;
                header('Location: adminproducts.php');
            }
    

    else
    {
        $query = "UPDATE product SET top_selling = '$top_selling', product_image='$update_filename', product_name='$product_name', product_description='$product_description', category_id='$category_id', product_price='$product_price' WHERE product_id = '$product_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            if($_FILES['product_image']['name'] !='')
            {
                move_uploaded_file($_FILES["product_image"]["tmp_name"], "upload/".$_FILES["product_image"]["name"]);
                unlink("upload/".$old_image);
            }
            $_SESSION['status'] = "Updated Successfully";
            header("Location: adminproducts.php");
        }
        else{
            $_SESSION['status'] = "Not Updated";
            header("Location: adminproducts.php");
        }
    }
}




if(isset($_POST['product_update'])){
    $product_id = $_POST['product_id'];

    $product_name =$_POST['product_name'];
    $product_description =$_POST['product_description'];
    $category_id =$_POST['category_id'];
    $product_price =$_POST['product_price'];
    $top_selling =$_POST['top_selling'];

    $new_image = $_FILES['product_image']['name'];
    $old_image = $_POST['product_image_old'];

    if($new_image != '')
    {
        $update_filename = $_FILES['product_image']['name'];
    }
    else
    {
        $update_filename = $old_image;
    }

    if($_FILES['product_image']['name'] !='')
    {

    if(file_exists("upload/" . $_FILES['product_image']['name']))
    {
        $filename = $_FILES['product_image']['name'];
        $_SESSION['status'] = "Image already Exists".$filename;
        header('Location: adminproducts.php');
    }
}
    else
    {
        $query = "UPDATE product SET top_selling = '$top_selling', product_image='$update_filename', product_name='$product_name', product_description='$product_description', category_id='$category_id', product_price='$product_price' WHERE product_id = '$product_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            if($_FILES['product_image']['name'] !='')
            {
                move_uploaded_file($_FILES["product_image"]["tmp_name"], "upload/".$_FILES["product_image"]["name"]);
                unlink("upload/".$old_image);
            }
            $_SESSION['status'] = "Updated Successfully";
            header("Location: adminproducts.php");
        }
        else{
            $_SESSION['status'] = "Not Updated";
            header("Location: adminproducts.php");
        }
    }
}
?>