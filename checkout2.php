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

$sql = "SELECT CONCAT(cart_product_name, '(',order_quantity,')') AS ItemQty, order_total_price FROM cart WHERE customer_id = $customer_id AND cart_status = '1'";
$stmt = $conn->prepare($sql);
$stmt ->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    $grand_total +=$row['order_total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(", ", $items);

if(isset($_POST['place_order'])){
    $allItems = $_POST['products'];
    $customer_id = $_POST['customer_id'];
    $grand_total = $_POST['grand_total'];

    $select_order = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id = $customer_id");

        $sql = "INSERT INTO ordered_product (customer_id,ordered_product,sub_total) VALUES ('$customer_id','$allItems','$grand_total')";
        $query = mysqli_query($conn,$sql);
    if($query){
        $sql2 = "UPDATE cart SET cart_status = '0' WHERE $customer_id = ' $customer_id'";
        $result = mysqli_query($conn,$sql2);
        header('location: confirm_order.php');
    }else{
        echo 'error';
    }
    };


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
                        <h3 class="text-center">Checkout</h3>
                    </div>
                </div>
            </div>
            <?php
                        $cart_query = mysqli_query($conn, "SELECT * FROM customer 
                                 WHERE customer_id = '$customer_id';") or die ('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){

                        ?>
            <div class="col-sm-8">
                <div class="container mb-2 p-2 bg-light">
                    <div class="row row-cols-8">
                        <div class="row m-2">
                            <div class="col-8">
                                Shipping Address
                            </div>
                            <div class="col-4">
                            <a href="editship.php?customer_id=<?php echo $fetch_cart['customer_id']; ?>" class="btn btn-primary float-end">Edit</a>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col"> <br>
                                <?php
                                echo $fetch_cart['customer_firstname'],' ', $fetch_cart['customer_lastname'];
                                ?>
                            <br>
                                <?php
                                echo $fetch_cart['customer_number'];
                                ?>
                            <br>
                                <?php
                                echo $fetch_cart['customer_address'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
} 
                    }
?>

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



                                    <?php 
                                    $sub_total = $fetch_cart['order_price'] * $fetch_cart['order_quantity'];
       
                                    ?>


                        </div>
                    </div>
                </div>
                <?php
                            $grand_total += $sub_total;

                            };
                            }else{
                                echo '<tr><td>No Item</td></tr>';
                            }
                ?>
            </div>
            <div class="col-sm-4 p-2 bg-light">
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
                <div class="row justify-content-md-center " id="order">
                <?php
                        $cart_query = mysqli_query($conn, "SELECT * FROM customer 
                                 WHERE customer_id = '$customer_id';") or die ('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){

                        ?>
                    <form action="" method="post">
                        <input type="hidden" name="products" value="<?= $allItems; ?>">
                        <input type="hidden" name="customer_id" value="<?= $fetch_cart['customer_id'] ?>">
                        <input type="hidden" name="grand_total" value="<?= number_format($grand_total,2) ?>">
                        <?php }} ?>
                        <input type="submit" name="place_order" value="Place Order" class="btn btn-warning btn-block place_order">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

    <script type="text/javascript">
       $(document).ready(function(){
           $("#placeOrder").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'action.php',
                method: 'post',
                data: $('form').serialize()+"&action=order",
                success: function(response){
                    $("order").html(response);
                }
            });
           });
           load_cart_item_number();

           function load_cart_item_number(){
               $.ajax({
                   url: 'action.php',
                   method: 'get',
                   data: {cartItem:"cart_item"},
                   success:function(response){
                       $("#cart-item").html(response);
                   }
               });
           }
       });
    </script>
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