<?php

include 'db_conn.php';

// category

if(isset($_POST['updateid'])){
    $category_id = $_POST['updateid'];

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

if(isset($_POST['hiddendata'])){
    $hiddendata = $_POST['hiddendata'];
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $sql = "UPDATE category SET category_name='$category_name', category_description= '$category_description' WHERE category_id = '$hiddendata'";
    $result = mysqli_query($conn,$sql);

    if($result)
    {
      echo '<div class="alert alert-warning alert-dismissible mb-0 fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong> Product already added to your cart.</strong>
          </div>';
          header('Location: admincategory.php');
    }
    else
    {
      
        header('Location: admincategory.php');
    }
}



?>

