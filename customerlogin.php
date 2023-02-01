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
    <title>home</title>
</head>
<div
  class="bg-image"
  style="
    background-image: url(images/loginbackground.png);
    height: 100vh;
    background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  "
>
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
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <h2>LOGIN</h2>
                                <?php if (isset($_GET['error'])){ ?>
                                <p class="error"><?php echo $_GET['error']; ?></p>
                                <?php  } ?>
                                <div class=" mt-5">
                                <label>User Name</label>
                                <input type="text" name="uname" class="form-control my-2 py-2"
                                    placeholder="User Name">
                                    </div>
                                <label>Password</label>
                                <input type="password" class="form-control my-2 py-2" name="password"
                                    placeholder="Password">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <a href="signup.php" class="nav-link">Creat an account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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