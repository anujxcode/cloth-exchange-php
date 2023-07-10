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
            include"conn.php";
            $email = $_SESSION['user'];
            $sql = "SELECT * FROM users WHERE email = '$email' ";
            $res = mysqli_query($conn,$sql);
            if(mysqli_num_rows($res)===1){
                $row = mysqli_fetch_assoc($res);
            }
        ?>
        <?php if(isset($_SESSION['user'])){ ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html" style="font-weight:600 ;">Clothes <span style="color:#835353;"> Exchange</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link " aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Product</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                  
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                           <?php if(isset($_SESSION['user']) ){?>
                            <li class="nav-item"><a class="nav-link" href="profile.php"><b>Hello</b>,  <?php echo $_SESSION['name'] ?></a> </li>
                            <li class="nav-item"><a class="nav-link" href="logout.php"> &nbsp;&nbsp;&nbsp;&nbsp;| logout</a></li>

                            <form  style="margin-left:30px">
                            <a class="btn" href="card.php">
                                    <i class="bi-cart-fill me-1"></i>
                                 </a>
                        </form>
                            <?php }else{ ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                            <?php }?>
                        </ul>
                       
                    </div>
                </div>
            </div>
        </nav>

        <div class="profile">
            <div class="profile-info">
                <h3>Hello <span><?php echo $row['first_name']; ?></span></h3>
                
                
            </div>
        </div>




   <?php } else{
        header("location:index.php");
        exit();
   } ?>

   
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
