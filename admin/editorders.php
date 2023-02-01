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
    <!-- <?php 
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


    ?> -->

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
            <?php 
                                if(isset($_GET['ordered_product_id']))
                                {
                                    $ordered_product_id = $_GET['ordered_product_id'];
                                    $query = "SELECT * FROM ordered_product JOIN customer ON ordered_product.customer_id = customer.customer_id WHERE ordered_product_id = $ordered_product_id";
                                    $query_run = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                            ?>
            <div class="container ">
            <?php
                                        while($row = mysqli_fetch_assoc($query_run))
                                        {
                                    ?>
                <h4 class="ml-9">Order Details</h4>
               
                <div class="row border rounded">
                <form action = "invoice.php" method="post" target="_blank" rel="noopener noreferrer">
                <input type="hidden" name="sub_total" class="form-control " value="<?php echo $row['sub_total']?>" >
                <input type="hidden" name="ordered_product" class="form-control " value="<?php echo $row['ordered_product']?>" >
                <input type="hidden" name="customer_address" class="form-control " value="<?php echo $row['customer_address']?>" >
                <input type="hidden" name="customer_number" class="form-control " value="<?php echo $row['customer_number']?>" >
                <input type="hidden" name="customer_lastname" class="form-control " value="<?php echo $row['customer_lastname']?>" >
                <input type="hidden" name="customer_id" class="form-control " value="<?php echo $row['customer_id']?>" >
                <input type="hidden" name="ordered_product_id" class="form-control " value="<?php echo $row['ordered_product_id']?>" >
                <input type="hidden" name="date_analytics" class="form-control " value="<?php echo $row['date_analytics']?>" >
                <input type="hidden" name="customer_firstname" class="form-control " value="<?php echo $row['customer_firstname']?>" >
                    <input type="submit" name="invoice_order" class="btn btn-success float-end mt-3" value="Invoice">
                </form>
                    <div class="col-sm-7 mt-3">
                        <h5 class="mb-4">Delivery Details</h5>
                        <hr>
                        <div class="container">
                     
                            <div class="row row-cols-2">
                                <div class="col mb-4">
                                    <label class="fw-semibold">Firstname</label>
                                    <input type="text" value="<?php echo $row['customer_firstname']?>"
                                        class="form-control " placeholder="" disabled />
                                </div>
                                <div class="col mb-4">
                                    <label class="fw-semibold">Lastname</label>
                                    <input type="text" value="<?php echo $row['customer_lastname']?>"
                                        class="form-control" placeholder="" disabled />
                                </div>
                                <div class="col mb-4">
                                    <label class="fw-semibold">Contact No.</label>
                                    <input type="text" value="<?php echo $row['customer_number']?>" class="form-control"
                                        placeholder="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label class="fw-semibold">Address</label>
                            <input type="text" name="Address" value="<?php echo $row['customer_address']?>"
                                class="form-control " placeholder="" disabled />
                        </div>
                    </div>

                    <div class="col-sm-5 ">
                        <table class="table border-white mt-4">
                            <thead class="table-primary">
                                <tr>
                                    <th>Products</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>

                            <tbody>
                                <td><?php echo $row['ordered_product']?></td>
                                <td><?php echo $row['sub_total']?></td>
                            </tbody>

                        </table>
                        <hr>
                        <div class="container">
                            <div class="row row-cols-1">
                                <div class="col mb-1">Order No. : <?php echo $row['ordered_product_id']?></div>
                                <div class="col mb-1">Order Status :
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
                                <div class="col">Order Placed at : <?php echo $row['order_date']?></div>
                            </div>
                        </div>
                        <hr>
                        <br>

                        <form action="updateorders.php" method="post">
                            <div class="container">
   
                                    <h5 class="mb-3">Update Order Status</h5>
                              
                                <div class="row row-cols-1">
                                    <div class="col mb-1">
                                        <div class="form-group">
                                            <input type="hidden" name="ordered_product_id"
                                                value="<?php echo $row['ordered_product_id']?>" class="form-control"
                                                placeholder="Enter">
                                            <select class="form-select" name="order_status"  aria-label="Default select example">
                                                <?php 
                                                     if($row['order_status'] == '1')
                                                     {
                                                         echo '<option value="1">In Progress</option>
                                                         <option value="2">Delivered</option>
                                                         <option value="3">Cancelled</option>';
                                                     }
                                                     if($row['order_status'] == '2')
                                                     {
                                                         echo '<option value="2">Delivered</option>
                                                         <option value="1">In Progress</option>
                                                         <option value="3">Cancelled</option>';
                                                     }
                                                     if($row['order_status'] == '3')
                                                     {
                                                         echo '<option value="3">Cancelled</option>
                                                         <option value="1">In Progress</option>
                                                         <option value="2">Delivered</option>';
                                                     }  
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-5">
                                <button type="submit" name="order_update" class="btn btn-primary">update</button>
                            </div>
                        </form>
                        <?php
                    }?>
                    </div>

                    <?php
                                    }
                                    
                                    else{
                                        echo "No Record";
                                    }
                                }
                                ?>
                </div>
            </div>
        </div>
    </div>


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