<?php

include 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/7e4965f98c.js" crossorigin="anonymous"></script>

    <title>product</title>
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



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="text-center">Products</h3>
                    </div>
                </div>
            </div>
            <!-- brand list --->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-5">
                        <div class="card-header">
                            <h5>Filter
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Menu List</h6>
                            <hr>
                            <?php 
                        $con = mysqli_connect("localhost", "root","","heavens_plate");
                        $brand_query = "SELECT * FROM category WHERE categ_status = '1' ";
                        $brand_query_run = mysqli_query($con, $brand_query);

                        if(mysqli_num_rows($brand_query_run) > 0){
                            foreach( $brand_query_run as $brandlist)
                            {
                                $checked = [];
                                if(isset($_GET['category_name']))
                                {
                                    $checked = $_GET['category_name'];
                                }
                                ?>
                            <div>
                                <input type="checkbox" name="category_name[]" value="<?= $brandlist['category_id']; ?>"
                                    <?php if(in_array($brandlist['category_id'],$checked)){echo "checked";} ?> />
                                <?= $brandlist['category_name']; ?>
                            </div>
                            <?php
                            }
                        }
                        else{
                            echo "No Item Found";
                        }
                    ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- brand items --->
            <div class="col-md-9 mt-3">
                <div ckass="card">
                    <div class="card-body row ">
                        <?php
                    if(isset($_GET['category_name']))
                    {
                        $branchecked = [];
                        $branchecked = $_GET['category_name'];
                        foreach($branchecked  as $rowbrand)
                        {
                            // echo $rowbrand;
                            $product ="SELECT * FROM product WHERE category_id IN($rowbrand) AND product_status = '1'";
                            $product_run = mysqli_query($con, $product );
                                 if(mysqli_num_rows($brand_query_run) > 0)
                                     {
                                        foreach($product_run as $product_items) :
                                        ?>
                        <div class="col-md-4 mt-3">
                            <div class=" card shadow border">
                                <div>
                                    <img src="images\<?= $product_items['product_image']; ?> "
                                        class="img-fluid card-img-top">
                                </div>
                                <hr>
                                <div class="card-body">
                                    <h5 class="card-title text-center p-1 bg-warning text-dark rounded-pill"><?= $product_items['product_name']; ?></h5>
                                    <div class="card-body">
                                        <h5>
                                            <span class="price">₱
                                                <?= number_format($product_items['product_price']); ?>.00</span>
                                        </h5>
                                        <div class="card-body">
                                            <!-- <form action="" class="form-submit"> -->
                                            <form action="" method="POST">
                                                <input type="hidden" name="product_id"
                                                    value="<?= $product_items['product_id']; ?>">
                                                <input type="hidden" name="product_image"
                                                    value="<?= $product_items['product_image']; ?>">
                                                <input type="hidden" name="product_name"
                                                    value="<?= $product_items['product_name']; ?>">
                                                <input type="hidden" name="product_price"
                                                    value="<?= $product_items['product_price']; ?>">
                                                    <a href="index.php" class="text-decoration-none">
                                                <input type="button"
                                                    class="btn btn-outline-warning border-warning form-control addItemBtn "
                                                    value="Add to Cart" name=""></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        endforeach;
                    }
                        else{
                            echo "No Item Found";
                        }
                        }
                    }
                    else
                    {

                    $product ="SELECT * FROM product WHERE product_status = '1'";
                    $product_run = mysqli_query($con, $product );
                    if(mysqli_num_rows($brand_query_run) > 0)
                    {
                        foreach($product_run as $product_items) :
                            ?>
                        <div class="col-md-4 mt-3">
                            <div class="card shadow h-100 border p-2 ">
                                <div class="card-body">
                                    <img src="admin\upload\<?= $product_items['product_image'] ?> "
                                        class="img-fluid card-img-top">
                                </div>
                                <hr>
                                <div class="card-body">
                                    <h5 class="card-title text-center p-1 bg-warning text-dark rounded-pill"><?= $product_items['product_name'] ?></h5>

                                    <div class="card-body">
                                        <h5>
                                            <span class="price">₱
                                                <?= number_format($product_items['product_price']); ?>.00</span>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                    
                                        <form action="" method="POST">
                                            <input type="hidden" name="product_id"
                                                    value="<?= $product_items['product_id']; ?>">
                                                <input type="hidden" name="product_image"
                                                    value="<?= $product_items['product_image']; ?>">
                                                <input type="hidden" name="product_name"
                                                    value="<?= $product_items['product_name']; ?>">
                                                <input type="hidden" name="product_price"
                                                    value="<?= $product_items['product_price']; ?>">
                                                    <a href="index.php" class="text-decoration-none">
                                                <input type="button"
                                                    class="btn btn-outline-warning border-warning form-control addItemBtn "
                                                    value="Add to Cart" name=""></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        endforeach;
                    }
                        else{
                            echo "No Item Found";
                        }
                    }
                 ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $(".addItemBtn").click(function(e){
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var oid = $form.find(".oid").val();
                var pid = $form.find(".pid").val();
                var price = $form.find(".price").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {oid:oid,pid:pid,price:price},
                    success:function(response){
                        $("#message").html(response);
                    }
                });
            });
        });
    </script> -->

    <!-- <script type="text/javascript">
    //     $(document).ready(function(){
    //         $(".product_check").click(function(){
    //              $("#loader").show();

    //             var action = 'data';
    //             var category = get_filter_text('category_name');

    //             $.ajax({
    //                 url: 'action.php',
    //                 method: 'POST',
    //                 data:{action:action,category:category},
    //                 success:function(response){
    //                     $("#result").html(response);
    //                     $("#loader").hide();
    //                     $("#textchange").text("Filtered Products");
    //                 }
    //             });

    //         });
    //         function get_filter_text(text_id){
    //             var filterData = [];
    //             $('#'+text_id+':checked').each(function(){
    //                 filterData.push($(this).val());
    //             });
    //             return filterData;
    //         }
    //     });
    // </script> -->

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