<?php
session_start();
include 'db_conn.php';
if (isset($_SESSION['customer_firstname']) && isset($_SESSION['customer_email'])){
    $customer_id = $_SESSION['customer_id'];
    $customer_lastname = $_SESSION['customer_lastname'];
    $customer_firstname = $_SESSION['customer_firstname'];
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
                $select_rows = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id = $customer_id") or die ('query failed');
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
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="text-center">Checkout</h3>
                    </div>
                </div>
            </div>
            <?php
                        $cart_query = mysqli_query($conn, "SELECT * FROM customer 
                                 WHERE customer_lastname = '$customer_lastname';") or die ('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){

                        ?>
            <div class="col-sm-8">
                <div class="container">
                    <form action="" method="POST">
                        <div class="row-cols m-2 bg-white border">
                            <div class="row m-2">
                                <div class="col-8">
                                    Shipping Address
                                </div>
                                <div class="col-4">Edit
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col"> <br><?php
                            echo $fetch_cart['customer_firstname'],$fetch_cart['customer_lastname'];
                            ?>
                                    <br>
                                    <?php
                            echo $fetch_cart['customer_address'];
                            ?>
                                    <?php
                            echo $fetch_cart['customer_address'];
                            ?>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <?php 
} 
                    }
?>

                <div class="container ">
                    <form action="" method="POST">

                        <div class="row-cols m-2 bg-white border">
                            
                            <div class="row m-2">
                                <div class="col-8">
                                    Shipping Address
                                </div>
                                <div class="col-4">Edit
                                </div>
                            </div>
                            <div class="row m-2">
                            <div class="col"><img src="images\<?php echo $fetch_cart['cart_product_image']; ?>"
                                    style="width:80px;" class="rounded mx-auto d-block"></div>
                            <div class="col"><?php echo $fetch_cart['cart_product_name']; ?></div>
                            <div class="col row row-cols-2"><?php echo $fetch_cart['order_price']; ?>.00</div>
                            <div class="col">
                                <a href="cart.php?remove=<?php echo $fetch_cart['order_id'] ?>" class="delete-btn"
                                    onclick="return confirm('remove item from cart ?')">
                                    <h4><i class="fa-solid fa-trash text-danger p-1"></i></h4>
                                </a>

                            </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
            

            <?php
                        $cart_query = mysqli_query($conn, "SELECT * FROM cart 
                                JOIN customer ON cart.customer_id = customer.customer_id
                                 WHERE customer_lastname = '$customer_lastname';") or die ('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){

                        ?>
            <?php 
} 
                    }
?>
            <div class="col-sm-4 p-2">Place order</div>
        </div>
    </div>

</body>

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