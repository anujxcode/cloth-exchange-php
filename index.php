<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Exchange Clothes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    session_start();
    ?>

    <?php if (isset($_GET['successmsg'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="z-index:10000;position:fixed;bottom:30px;right:30px;width:60%;">
            <strong>Error!</strong> <?php echo $_GET['successmsg']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html" style="font-weight:600 ;">Clothes <span style="color:#835353;"> Exchange</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Product</a></li>
                </ul>

                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <?php if (isset($_SESSION['user'])) { ?>
                            <?php if(isset($_SESSION['is_admin'])){ ?>
                              <li class="nav-item">  <a href="admin.php"  class="nav-link">Admin Panel</a></li>
                            <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="profile.php"><b>Hello</b>, <?php echo $_SESSION['name'] ?></a> </li>
                            <li class="nav-item"><a class="nav-link" href="logout.php"> &nbsp;&nbsp;&nbsp;&nbsp;| logout</a></li>

                            <form style="margin-left:30px">
                             <a class="btn btn-outline-dark" href="order.php">
                                    Orders
                            </a>
                            </form>
                        <?php } else { ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                        <?php } ?>
                    </ul>

                </div>
            </div>
        </div>
    </nav>




    <!-- Header-->
    <header class="py-5 hero-banner">

        <div class="container px-4 px-lg-5 my-5">
            <div class="hero-text">
                <h1 class="display-4 fw-bolder text-white">Exchange Old Clothes And Get New Clothes </h1>
                <p class="lead  mb-0" style="color:#f4f4f4;">This is a site where you can exchange your old clothes with  Money .is this not a Amazing deal ?</p>
                <a href="product.php" class="btn btn-warning" style="margin-top:50px;">Exchange Now</a>
            </div>
        </div>
    </header>

    <!-- Section-->


    <!-- Footer-->
    <!-- <footer class="py-2 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy;  2022</p>
        </div>
    </footer> -->


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>