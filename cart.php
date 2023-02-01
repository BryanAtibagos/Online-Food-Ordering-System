<?php
session_start();

include 'db_conn.php';
if (isset($_SESSION['customer_firstname']) && isset($_SESSION['customer_email'])){
    $customer_id = $_SESSION['customer_id'];
    


    if(isset($_POST['add_to_cart'])){
        
        $product_id = $_POST['product_id'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_name = $_POST['product_name'];
        $product_quantity = 1;

        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = $product_id AND cart_status = '1' ");

        if(mysqli_num_rows($select_cart) > 0){
            echo '<div class="alert alert-warning alert-dismissible mb-0 fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong> Product already added to your cart.</strong>
          </div>';
        }
        else{
            $insert_product = mysqli_query($conn, "INSERT INTO cart (product_id,cart_product_image,cart_product_name,order_price,order_quantity) VALUES ('$product_id','$product_image','$product_name','$product_price','$grand_total') ");
            
        }
    };

// update cart
    if(isset($_POST['update_cart_decrement'])){

        $update_quantity = $_POST['cart_quantity'];
        $update_id = $_POST['cart_id'];
        $order_price = $_POST['order_price'];
        $update_quantity --;
        $order_total_price =  ($update_quantity * $order_price);
        mysqli_query($conn, "UPDATE cart SET order_quantity = '$update_quantity', order_total_price ='$order_total_price' WHERE order_id = ' $update_id'") or die('query failed');
    }
    if(isset($_POST['update_cart_increment'])){

        $update_quantity = $_POST['cart_quantity'];
        $update_id = $_POST['cart_id'];
        $order_price = $_POST['order_price'];
        $update_quantity ++;
        $order_total_price = ($update_quantity * $order_price);
        mysqli_query($conn, "UPDATE cart SET order_quantity = '$update_quantity', order_total_price ='$order_total_price' WHERE order_id = ' $update_id'") or die('query failed');
    }
    if(isset($_GET['remove'])){
        $remove_id= $_GET['remove'];
        mysqli_query($conn, "DELETE FROM cart WHERE order_id = '$remove_id'") or die('query failed');
    }
    if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM cart WHERE customer_id = '$customer_id'") or die('query failed');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/7e4965f98c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>home</title>
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
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="text-center">Cart</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-5">
                <div class="card-header bg-light">
                    <h5>Products
                        <a href="cart.php?delete_all" onclick="return confirm('delete all from cart?');"
                            class="delete-btn float-end rounded p-1 border border-danger text-danger text-decoration-none">Delete
                            all</a>
                    </h5>
                </div>
                <?php 
                    $grand_total = 0;
                    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id = $customer_id AND cart_status = '1'") or die ('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){

                        ?>
                <div class="card-body bg-light">
                    <div class="container">
                        <div class="row row-cols-8">
                            <div class="col"><img src="images\<?php echo $fetch_cart['cart_product_image']; ?>"
                                    style="width:80px;" class="rounded mx-auto d-block"></div>
                            <div class="col"><?php echo $fetch_cart['cart_product_name']; ?></div>
                            <div class="col row row-cols-2">₱ <?php  echo number_format($fetch_cart['order_price'],2); ?>
                            </div>
                            <div class="col">
                                <a href="cart.php?remove=<?php echo $fetch_cart['order_id'] ?>" class="delete-btn"
                                    onclick="return confirm('remove item from cart ?')">
                                    <h4><i class="fa-solid fa-trash text-danger p-1"></i></h4>
                                </a>

                            </div>
                            <div class="col-3">
                                <form action="" method="post">
                                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['order_id']; ?>">
                                    <input type="submit" name="update_cart_decrement" value="-" class="option-btn "
                                        style="width: 30px; ">
                                    <input type="number" style="width: 40px;" min="1" max="255" name="cart_quantity"
                                        value="<?php echo $fetch_cart['order_quantity']; ?>" readonly>
                                    <input type="hidden" style="width: 40px;" min="1" max="255" name="order_price"
                                        value="<?php echo $fetch_cart['order_price']; ?>" readonly>
                                    <input type="submit" name="update_cart_increment" value="+" class="option-btn "
                                        style="width: 30px; ">
                                </form>
                            </div>
                            <!-- <div class="col">
                                <h6>₱
                                    <?php 
                                    $sub_total = $fetch_cart['order_price'] * $fetch_cart['order_quantity'];
                                    $Total_amount += $fetch_cart['order_price'] * $fetch_cart['order_quantity'] ;  $fetch_cart['order_price'] * $fetch_cart['order_quantity'];
                                    ?>
                                </h6>
                            </div> -->

                        </div>
                    </div>
                </div>
                <?php
                            $grand_total += $sub_total;

                            };
                            }else{
                                echo '<tr><td>No Item Added</td></tr>';
                            }
                ?>
            </div>
            <div class="col-md-4 mt-5 bg-light">
                <div class="card-header bg-light">
                    <h5>Order Summary</h5>
                </div>
                <div class="row p-4 ">
                    <div class="col-md-8">Subtotal</div>
                    <div class="col-6 col-md-4">₱ <?php echo number_format($grand_total,2); ?></div>
                </div>
                <div class="row p-4 ">
                    <div class="col-md-8">Shipping Fee</div>
                    <div class="col-6 col-md-4">Free</div>
                </div>
                <hr>
                <div class="row p-4">
                    <div class="col-md-8">Subtotal</div>
                    <div class="col-6 col-md-4 ">
                        <h5>₱ <?php echo number_format($grand_total,2); ?></h5>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <a href="checkout2.php" class="btn bg-warning <?=($grand_total>1)?"":"disabled"; ?>">Proceed
                        Checkout</a>
                </div>
            </div>



        </div>
    </div>
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
</body>

</html>

<?php
}else{
    header("Location: customerlogin.php");
               exit();
}
?>