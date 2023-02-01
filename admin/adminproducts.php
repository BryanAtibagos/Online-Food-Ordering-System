<?php 
session_start();
include 'db_conn.php';
if (isset($_SESSION['admin_firstname']) && isset($_SESSION['admin_email'])){
    $admin_firstname = $_SESSION['admin_firstname'];
    $admin_id = $_SESSION['admin_id'];
// if(isset($_POST['insertdata']))
// {
    
//     $category_name = $_POST['category_name'];
//     $category_description = $_POST['category_description'];

//     $query ="INSERT INTO category (product_id,category_name,category_description) VALUES ($product_id,$product_category_nameimage,$category_description)";
//     $query_run = mysqli_query($conn, $query);

//     if($query_run)
//     {
//         echo'<script> alert("Data Saved"); </script>';
//         header('Location: adminproducts.php');
//     }else
//     {
//         echo '<script> alert("Data Not Saved"); </script>';
//     }
// }
if(isset($_GET['remove'])){
    $remove_id= $_GET['remove'];
    $order_status = mysqli_query($conn, "UPDATE product SET product_status = '0'  WHERE product_id = '$remove_id' ") or die('query failed');
    if($order_status)
    {
        echo '<script> alert("Data Updated"); </script>';
        header('Location: adminproducts.php');
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
        header('Location: adminproducts.php');
    }
}
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
    // if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    // {
    //     echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
    //     unset($_SESSION['success']);
    // }

    // if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    // {
    //     echo '<h2 class="bg-primary text-white">'.$_SESSION['status'].'</h2>';
    //     unset($_SESSION['status']);
    // }

?>

<?php


?>
    <!-- edit -->
    <div class="modal fade" id="editp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="updateproduct.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php
                            $conn = mysqli_connect("localhost","root","","heavens_plate");

                            $product_id = $_GET['product_id'];
                            $query ="SELECT * FROM product WHERE product_id = '$product_id'";
                            $query_run = mysqli_query($conn)
                        ?>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" id="product_image" name="product_image" class="form-control"
                                placeholder="Enter">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="product_name" name="product_name" class="form-control"
                                placeholder="Enter">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" id="product_description" name="product_description" class="form-control"
                                placeholder="Enter">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" id="category_id" name="category_id" class="form-control"
                                placeholder="Enter">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" id="product_price" name="product_price" class="form-control"
                                placeholder="Enter">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary " name="update_product">Save changes</button>
                        <input type="hidden" id="hiddendata">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="addproduct.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="product_image" id="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="product_description" class="form-control" placeholder="Enter">
                        </div>
                        <?php 
                    $mysli= new mysqli('localhost','root','','heavens_plate');
                    $resultset=$mysli->query("SELECT category_id,category_name FROM category WHERE categ_status='1'");
                ?>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-select" required>
                                <option hidden value=''>Select category</option>
                                <?php 
                                    while ($rows=$resultset->fetch_assoc())
                                    {
                                        $category_id = $rows['category_id'];
                                        $category_name = $rows['category_name'];
                                        echo "<option  value='$category_id'>$category_name</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="product_price" class="form-control" placeholder="Enter">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insert_product" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Heavens Plate</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Basic</p>
                <li>
                    <a href="admindashboard.php">Dashboard</a>
                </li>
                <hr>
                <p>Manage</p>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Orders</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="adminorders.php">Orders</a>
                        </li>
                        <li>
                            <a href="admindelivered.php">Delivered</a>
                        </li>
                        <li>
                            <a href="admincancelled.php">Cancelled</a>
                        </li>

                    </ul>
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
                            <li class="nav-item active  dropdown">
                                <a class="nav-link dropdown-toggle  mr-5" id="navbardrop" data-toggle="dropdown" href="#"><?php echo $_SESSION['admin_firstname'];?></a>
                                <div class="dropdown-menu">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                Add Records
            </button>
            <hr>
            <?php 
                $query = "SELECT * FROM product JOIN category ON product.category_id = category.category_id WHERE product_status = '1'";
                $query_run = mysqli_query($conn, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                ?>
            <table class="table table-bordered table-striped  table-hover">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                       ?>
                    <tr>
                        <td><?php echo $row['product_id']?></td>
                        <td><img src="upload/<?php echo $row['product_image'] ?>" style="width:80px;"></td>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['category_name']?></td>
                        <td><?php echo number_format($row['product_price'],2)?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary editbtn" data-toggle="modal"
                                data-target="#editp">Update

                            </button> -->
                            <a href="edit.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-info">Edit</a>

                            <!-- Button trigger modal -->
                            <a href="adminproducts.php?remove=<?php echo $row['product_id'] ?>" class="delete-btn"
                                    onclick="return confirm('remove item from cart ?')">
                                   <button type="button" class="btn btn-danger editbtn">Delete </button>
                                </a>

                        </td>
                    </tr>


                    <?php
                    }


?>

                </tbody>
            </table>
            <?php
            }
              
            else{
                echo "No Record";
            }
            
            ?>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('table').DataTable();
    });
    </script>



    <!--- update --->
    <script>
    function GetProductid(updateid) {
        $('#hiddendata').val(updateid);

        $.post("updateproduct.php", {
            updateid: updateid
        }, function(data, status) {
            var product_id = JSON.parse(data);
            $('#product_image').val(product_id.product_image);
            $('#product_name').val(product_id.product_name);
            $('#product_description').val(product_id.product_description);
            $('#category_id').val(product_id.category_id);
            $('#product_price').val(product_id.product_price);
        });
        $('#updateModal').modal("show");
    }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>


</body>

</html>

<?php 

}else{
    header("Location:loginadmin.php");
    exit();
}
?>