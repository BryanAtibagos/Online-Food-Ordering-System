<?php
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
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="adminstyle.css">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>




    <!-- edit -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="updatecode.php" method="post">
                    <div class="modal-body">



                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="category_name" name="category_name" class="form-control"
                                placeholder="Enter">

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" id="category_description" name="category_description"
                                class="form-control" placeholder="Enter">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary " onclick="updateDetails()">Save changes</button>
                        <input type="hidden" id="hiddendata">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="deletecode.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="delete_id" name="delete_id" class="form-control" placeholder="Enter">
                        <input type="hidden" id="categ_status" name="categ_status" class="form-control"
                            placeholder="Enter">
                        <h4>Do you want to Delete this data ?</h4>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="delete_categ" class="btn btn-primary ">Yes</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- add -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addproduct.php" method="post">
                    <div class="modal-body">

                        <input type="hidden" name="category_id" class="form-control" placeholder="Enter">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="category_name" class="form-control" placeholder="Enter">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="category_description" class="form-control" placeholder="Enter">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="insert_categ" class="btn btn-primary ">Save changes</button>
                        <input type="hidden" id="hiddendata">
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
                    <a href="#">Dashboard</a>
                </li>
                <hr>
                <p>Manage</p>
                <li>
                    <a href="#">Orders</a>
                </li>
                <li class="">
                    <a href="adminproducts.php">Products</a>
                </li>
                <li class="active">
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

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                Add Records
            </button>
            <hr>

            <table id="example" class="table table-striped" style="width:100%">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql="SELECT * from category";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $category_id =$row['category_id'];
                            $category_name =$row['category_name'];
                            $category_description =$row['category_description'];
                            echo '<tr>
                        <td>'.$category_id.'</td>
                        <td>'.$category_name.'</td>
                        <td>'.$category_description.'</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary editbtn" onclick="GetDetails('.$category_id.')">Update
                               
                            </button>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger deletebtn" >
                                <a href="delete.php?deleteid='.$category_id.'"> Delete</a>
                            </button>

                        </td>
                    </tr>';
                        }
                    }
                        ?>

                </tbody>
            </table>
        </div>
    </div>
    <!--- menu -->
    <script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
    </script>
    <!--- Table -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('table').DataTable();
    });
    </script>
    </script>

    <!--- update --->
    <script>
    function GetDetails(updateid) {
        $('#hiddendata').val(updateid);

        $.post("update.php", {
            updateid: updateid
        }, function(data, status) {
            var category_id = JSON.parse(data);
            $('#category_name').val(category_id.category_name);
            $('#category_description').val(category_id.category_description);
        });
        $('#updateModal').modal("show");
    }
    //onclick update
    function updateDetails() {
        var category_name = $('#category_name').val();
        var category_description = $('#category_description').val();
        var hiddendata = $('#hiddendata').val();

        $.post("update.php", {
            category_name: category_name,
            category_description: category_description,
            hiddendata: hiddendata
        }, function(data, status) {
            $('#updateModal').modal('hide');
            displayData();

        });
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