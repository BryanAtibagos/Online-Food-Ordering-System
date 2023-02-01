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
        $order = mysqli_query($conn, "UPDATE ordered_product SET order_status = '3' WHERE ordered_product_id = ' $remove_id'") or die('query failed');

        if($order){
            $_SESSION['status'] ="Record has been placed";
            header('Location: confirm_order.php');
        }
        else
        {
            $_SESSION['status'] ="Record Not saved";
            header('Location: confirm_order.php');
        }
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
    <?php 
                                if(isset($_GET['ordered_product_id']))
                                {
                                    $ordered_product_id = $_GET['ordered_product_id'];
                                    $query = "SELECT * FROM ordered_product JOIN customer ON ordered_product.customer_id = customer.customer_id WHERE ordered_product_id = $ordered_product_id";
                                    $query_run = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                            ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="">Order Details</h3>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <?php
                                        while($row = mysqli_fetch_assoc($query_run))
                                        {
                                    ?>
        <div class="card mb-3">
            <h5 class="card-header">My Delivery Details</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                            <input type="email" class="form-control bg-white"
                                value="<?php echo $row['customer_firstname'] ?>" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                            <input type="email" class="form-control bg-white"
                                value="<?php echo $row['customer_lastname'] ?>" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Contact Number</label>
                            <input type="email" class="form-control bg-white"
                                value="<?php echo $row['customer_number'] ?>" readonly />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Address</label>
                            <input type="email" class="form-control bg-white"
                                value="<?php echo $row['customer_address'] ?>" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">My Order Details</h5>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col">
                        Order No. : <?php echo $row['ordered_product_id'] ?>
                    </div>
                    <div class="col">
                        Order Placed at : <?php echo $row['order_date'] ?>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">Order Status :
                        <?php 
                                    if($row['order_status'] == '1')
                                    {
                                        echo '<div class="bg-warning text-white p-1 rounded d-inline">Pending</div>';
                                    }
                                    if($row['order_status'] == '2')
                                    {
                                        echo '<div class="bg-success p-1 text-white rounded d-inline">Delivered</div>';
                                    }
                                    if($row['order_status'] == '3')
                                    {
                                        echo '<div class="bg-danger p-1 text-white rounded d-inline">Cancelled</div>';
                                    }  
                                    ?>
                    </div>
                    <div class="col">
                        Total Amount : ₱ <?php echo number_format($row['sub_total'],2); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Products</h6>
                    </div>
                </div>
                <div class="row">
                <div class="col">
                    <?php echo $row['ordered_product']; ?>
                </div>
               
                <div class="col">
                <form action="editcustomerorder.php" method="POST">
                    <?php
                    if ($row['order_status'] == '1') { ?>
                                    <a href="editcustomerorder.php?remove=<?php echo $row['ordered_product_id'] ?>" class="delete-btn"
                                    onclick="return confirm('remove item from cart ?')">
                                    <?php echo '<button type="button" class="btn btn-danger">Cancel Order</button>'; }else {echo '';} ?>
                                   
                   </form>
                </div>
               
            </div>
        </div>
    </div>
    <?php
                                    }
                                }
                                    
                                    else{
                                        echo "No Record";
                                    }
                                }
                            
                                ?>


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