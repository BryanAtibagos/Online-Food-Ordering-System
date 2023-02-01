<?php session_start();
include 'db_conn.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
    <script src='https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js'></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" charset="utf-8"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <script src="https://kit.fontawesome.com/7e4965f98c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="admincssstyles.css">
    <title>Admin</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <?php 
    if(isset($_SESSION['status']) && $_SESSION !='')
    {
        ?>
    <div class="alert alert-warning alert-dismissible fade-show" rolse="alert">
        <strong>HEY!</strong><?php echo $_SESSION['status']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">

        </button>
    </div>

    <?php
        unset($_SESSION['status']);
    }


    ?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Heavens Plate</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Basic</p>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="admindashboard.php">Dashboard</a>
                </li>
                <hr>
                <p>Manage</p>
                <li>
                    <a href="adminorders.php">Orders</a>
                </li>
                <li class="active">
                    <a href="adminproducts.php">Products</a>
                </li>
                <li>
                    <a href="admincategory.php">Category</a>
                </li>

            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Admin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>




            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                </div>
                <div class="modal-body">
                    <?php
                           if(isset($_GET['product_id']))
                           {
                               $product_id = $_GET['product_id'];
                               $query = "SELECT * FROM product JOIN category ON product.category_id = category.category_id WHERE product_id = '$product_id'";
                               $query_run = mysqli_query($conn, $query);
                           

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $prodItem = mysqli_fetch_array($query_run);
                           
                                ?>

                    <form action="updateproduct.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?=$prodItem['product_id'] ?>" />

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="product_image" class="form-control">
                            <input type="hidden" name="product_image_old" value="<?=$prodItem['product_image'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="product_name" value="<?=$prodItem['product_name'] ?>"
                                class="form-control" placeholder="Enter" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="product_description" value="<?=$prodItem['product_description'] ?>"
                                class="form-control" placeholder="Enter" required>
                        </div>
                        <div class="form-group">
                            <label>category</label>
                            <?php 
                            $query = "SELECT * FROM category";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0 )
                            {
                                ?>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php foreach($query_run as $item){?>
                                <option value="<?=$item['category_id'] ?>"
                                    <?= $prodItem['category_id'] == $item['category_id'] ? 'selected':'' ?>>
                                    <?= $item['category_name'] ?></option>

                                <?php } ?>
                            </select>
                            <?php
                            }
?>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="product_price" value="<?=$prodItem['product_price'] ?>"
                                class="form-control" placeholder="Enter" required>
                        </div>
                        <div class="form-group">
                            <label>Trend</label>
                            <select class="form-select" name="top_selling" aria-label="Default select example">
                                <?php 
                                                     if($prodItem['top_selling'] == '0')
                                                     {
                                                         echo '<option value="0">On</option>
                                                         <option value="1">Off</option>';
                                                     }
                                                     if($prodItem['top_selling'] == '1')
                                                     {
                                                         echo '<option value="1">Off</option>
                                                         <option value="0">On</option>';
                                                     }
                                                ?>

                            </select>
                        </div>
                </div>
                <img src="upload/<?=$prodItem['product_image'] ?>" width="100px">
                <div class="modal-footer">
                    <a href="adminproducts.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Close
                        </button></a>
                    <button type="submit" name="product_update" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                <?php
                            }
                            else
                            {
                                echo "No product";
                            }
                        }
                               ?>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
                integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
                integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
                crossorigin="anonymous">
            </script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
            <script src="./js/script.js"></script>


</body>

</html>