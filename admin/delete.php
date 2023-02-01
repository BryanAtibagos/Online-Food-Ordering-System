<?php

include 'db_conn.php';


if(isset($_POST['deleteid'])){
    $category_id = $_POST['deleteid'];

    $sql="SELECT * from category where category_id=$category_id";
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
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $sql = "UPDATE category SET categ_status ='0' WHERE category_id = '$hiddendatadelete'";
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
      
        header('Location: admincategory.php');
    }
}
?>

