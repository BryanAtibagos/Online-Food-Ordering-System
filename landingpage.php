<?php

include 'db_conn.php';


    if(isset($_POST['add_to_cart'])){
        
          
        $product_id = $_POST['product_id'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = 1;

        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE product_id = $product_id");

        if(mysqli_num_rows($select_cart) > 0){
            echo '<div class="alert alert-warning alert-dismissible mb-0 fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong> Product already added to your cart.</strong>
          </div>';
        }
        else{
            $insert_product = mysqli_query($conn, "INSERT INTO cart (product_id,cart_product_image,cart_product_name,order_price,order_quantity) VALUES ('$product_id','$product_image','$product_name','$product_price','$product_quantity') ");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage1.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <script src="https://kit.fontawesome.com/7e4965f98c.js" crossorigin="anonymous"></script>
    <title>home</title>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-warning navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand text-dark ml-5" href="#">Heavens Plate</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse " id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="landingpage.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="landingpageproduct.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php" ><i
                            class="fa-solid fa-user"></i>Login
                    </a>
</li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link cart">
                        <i class="fas fa-shopping-cart text-dark"></i> <span
                            class="badge badge-danger"></span>

                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="\heavensplate\images\banner3.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><a class="btn btn-warning  " href="product.php">Order Now</a></h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="\heavensplate\images\banner2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><a class="btn btn-warning  " href="product.php">Order Now</a></h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="\heavensplate\images\banner3.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><a class="btn btn-warning  " href="product.php">Order Now</a></h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="\heavensplate\images\banner2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5><a class="btn btn-warning  " href="product.php">Order Now</a></h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <Br>
        <div class="text-wrap">
            <h4>Top Selling Products</h4>
        </div>
        <div class="row">
            <?php 
                    $cart_query = mysqli_query($conn, "SELECT * FROM product WHERE top_selling = '0' AND product_status='1'") or die ('query failed');
                    if(mysqli_num_rows($cart_query) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($cart_query)){

                        ?>
            <div class="col-md-3  mt-3">
                <div class=" card shadow h-100 border">
                    <div class="card-body row ">
                        <div>
                            <img src="admin/upload/<?= $fetch_cart['product_image']; ?> " class="img-fluid card-img-top">
                        </div>
                        <div class="card-body">
                            <hr>
                            <h5 class="card-title  text-center p-1  text-dark rounded-pill">
                                <?= $fetch_cart['product_name']; ?></h5>
                            <div class="card-body">
                                <h5>
                                    <span class="price">₱
                                        <?= number_format($fetch_cart['product_price']); ?>.00</span>
                                </h5>
                                    <form action="" method="POST">
                                        <input type="hidden" name="product_id"
                                            value="<?= $fetch_cart['product_id']; ?>">
                                        <input type="hidden" name="product_image"
                                            value="<?= $fetch_cart['product_image']; ?>">
                                        <input type="hidden" name="product_name"
                                            value="<?= $fetch_cart['product_name']; ?>">
                                        <input type="hidden" name="product_price"
                                            value="<?= $fetch_cart['product_price']; ?>">
                                            <br>
                                            <a href="index.php" class="text-decoration-none">
                                        <input type="button"
                                            class="btn-warning m-auto text-wrap border-warning form-control addItemBtn "
                                            value="Add to Cart" name=""></a>
                                    </form>
                  
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <?php }} ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
