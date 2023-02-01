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
    <title>Login</title>
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
                    <a class="nav-link text-dark" href="index.php"><i class="fa-solid fa-user"></i>Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link cart">
                        <i class="fas fa-shopping-cart text-dark"></i> <span class="badge badge-danger"></span>

                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <section>
        <div class="container mt-2 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="signupfunc.php" method="post">
                                <h2>SIGN UP</h2>
                                <?php if (isset($_GET['error'])) { ?>
                                <p class="error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>

                                <?php if (isset($_GET['success'])) { ?>
                                <p class="success"><?php echo $_GET['success']; ?></p>
                                <?php } ?>

                                <label>Firstname</label>
                                <?php if (isset($_GET['customer_firstname'])) { ?>
                                <input type="text" class="form-control  py-2" name="customer_firstname" placeholder="Name"
                                    value="<?php echo $_GET['customer_firstname']; ?>"><br>
                                <?php }else{ ?>
                                <input type="text" class="form-control  py-2" name="customer_firstname" placeholder="Name"><br>
                                <?php }?>

                                <label>Lastname</label>
                                <?php if (isset($_GET['customer_lastname'])) { ?>
                                <input type="text" class="form-control py-2" name="customer_lastname" placeholder="Name"
                                    value="<?php echo $_GET['customer_lastname']; ?>"><br>
                                <?php }else{ ?>
                                <input type="text" class="form-control py-2" name="customer_lastname" placeholder="Name"><br>
                                <?php }?>

                                <label>Address</label>
                                <?php if (isset($_GET['customer_address'])) { ?>
                                <input type="text" class="form-control  py-2" name="customer_address" placeholder="Name"
                                    value="<?php echo $_GET['customer_address']; ?>"><br>
                                <?php }else{ ?>
                                <input type="text" class="form-control  py-2" name="customer_address" placeholder="Name"><br>
                                <?php }?>
                                <label>Contact No.</label>
                                <?php if (isset($_GET['customer_number'])) { ?>
                                <input type="text" class="form-control py-2" name="customer_number" placeholder="Name"
                                    value="<?php echo $_GET['customer_number']; ?>"><br>
                                <?php }else{ ?>
                                <input type="text" class="form-control py-2" name="customer_number" placeholder="Name"><br>
                                <?php }?>

                                <label>Email</label>
                                <?php if (isset($_GET['customer_email'])) { ?>
                                <input type="text" class="form-control py-2" name="customer_email" placeholder="User Name"
                                    value="<?php echo $_GET['customer_email']; ?>"><br>
                                <?php }else{ ?>
                                <input type="text" class="form-control py-2" name="customer_email" placeholder="User Name"><br>
                                <?php }?>


                                <label>Password</label>
                                <input type="password" class="form-control  py-2" name="password" placeholder="Password"><br>

                                <label>Confirm Password</label>
                                <input type="password" class="form-control  py-2" name="re_password" placeholder="Confirm Password"><br>

                                <button type="submit"  class="btn btn-primary">Sign Up</button>
                                <a href="index.php" class="ca">Already have an account?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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