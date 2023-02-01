<?php
session_start();
require 'db_conn.php';
if (isset($_SESSION['customer_firstname']) && isset($_SESSION['customer_email'])){
    $customer_id = $_SESSION['customer_id'];
    $customer_lastname = $_SESSION['customer_lastname'];
    $customer_firstname = $_SESSION['customer_firstname'];

$grand_total = 0;
$allItems = '';
$items = array();

$sql = "SELECT CONCAT(cart_product_name, '(',order_quantity,')') AS ItemQty, order_total_price FROM cart WHERE customer_id = $customer_id AND cart_status = '1' ";
$stmt = $conn->prepare($sql);
$stmt ->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    $grand_total +=$row['order_total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(", ", $items);

if(isset($_POST['cancel_order'])){
    $ordered_product_id = $_POST['ordered_product_id'];
    $customer_id = $_POST['customer_id'];

    $select_order = mysqli_query($conn, "SELECT * FROM ordered_product WHERE ordered_product_id = $ordered_product_id ' ");

        $query = "DELETE FROM ordered_product WHERE ordered_product_id=$ordered_product_id";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['status'] ="Record has been placed";
            header('location: confirm_order.php');
        }
        else
        {
            $_SESSION['status'] ="Record Not saved";
            header('location: confirm_order.php');
        }
    };

    if(isset($_GET['remove'])){
        $remove_id= $_GET['remove'];
        mysqli_query($conn, "UPDATE ordered_product SET order_status = '3' WHERE ordered_product_id = ' $remove_id'") or die('query failed');
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/7e4965f98c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-warning navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand text-dark" href="#">Heavens Plate</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse " id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="product.php">Product</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbardrop" data-toggle="dropdown"><i
                            class="fa-solid fa-user"></i>
                        <?php echo $_SESSION['customer_firstname'];?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="confirm_order.php">My Orders</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
                <?php
                $select_rows = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id = $customer_id AND cart_status = '1'") or die ('query failed');
                $row_count = mysqli_num_rows($select_rows);
                ?>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link cart">
                        <i class="fas fa-shopping-cart text-dark"></i> <span
                            class="badge badge-danger"><?php echo $row_count; ?></span>

                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="text-center">My Orders</h3>
                    </div>
                </div>
                <br>
            </div>
            


        </div>
<div class=""><a href="mycancellations.php" class="btn btn-info">My Cancellations</a></div>
        <?php 

           
$cart_query = mysqli_query($conn, "SELECT * FROM ordered_product WHERE customer_id = $customer_id AND (order_status = '1' OR order_status = '2')  ORDER BY ordered_product_id DESC") or die ('query failed');
if(mysqli_num_rows($cart_query) > 0){
    while($fetch_cart = mysqli_fetch_assoc($cart_query)){

?>
        <div class="col mt-3 ">
          
            <div class="card">
                <div class="card-header">
                    Tracking No: <?php echo $fetch_cart['ordered_product_id']; ?>
                </div>
                <div class="card-body align-middle">
                    <div class="row  text-center fw-bolder">
                        <div class="col">Products</div>
                        <div class="col">Total Amount</div>
                        <div class="col">Status</div>
                        <div class="col">Action</div>
                    </div>
                    <div class="row  text-center">
                        <div class="col"><?php echo $fetch_cart['ordered_product']; ?></div>
                        <div class="col">₱ <?php echo number_format($fetch_cart['sub_total'],2); ?></div>
                        <div class="col"> <?php 
                            if($fetch_cart['order_status']  == 1){
                                echo '<div class="bg-warning text-white p-1 rounded d-inline">
                                In Progress
                              
                                </div>';
                                
                            }
                            if($fetch_cart['order_status']  == 2){
                                echo '<div class="bg-success p-1 text-white rounded d-inline">
                                Completed
                              
                                </Div>';
                                
                            }if($fetch_cart['order_status']  == 3){
                                echo '<div class="bg-danger p-1 text-white rounded d-inline">
                                Cancelled
                              
                                </div>';
                                
                            }
                        ?></div>
                        <div class="col">
                            
                            <!-- <a href="confirm_order.php?remove=" class="delete-btn" onclick="return confirm('Do you want to cancel your order ?')"> -->
                            <a href="editcustomerorder.php?ordered_product_id=<?php echo $fetch_cart['ordered_product_id']; ?>" class="btn btn-primary">View</a>
                            <!-- </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php }} ?>


</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<?php

}else{
    header("Location: customerlogin.php");
               exit();
}
?>