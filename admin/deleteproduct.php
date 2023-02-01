<?php

include 'db_conn.php';


if(isset($_POST['deleteid'])){
    $product_id = $_POST['deleteid'];

    $sql="SELECT * from product where product_id=$product_id";
    $result = mysqli_query($conn,$sql);
    $response = array();
    while($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
    echo json_encode($response);
}else{
    $response['status']=200;
    $response['message'] = "Invalid data not found";
}


//update query

if(isset($_POST['hiddendatadelete'])){
    $hiddendatadelete = $_POST['hiddendatadelete'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];

    $sql = "UPDATE product SET product_status ='0' WHERE product_id = '$hiddendatadelete'";
    $result = mysqli_query($conn,$sql);

    if($result)
    {
      echo '<div class="alert alert-warning alert-dismissible mb-0 fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong> Product already added to your cart.</strong>
          </div>';
    }
    else
    {
      
        header('Location: adminproducts.php');
    }
}
?>

