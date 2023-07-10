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
    include"conn.php";
    session_start();
    
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $data[] = $rows;
        }
    }
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
                    <li class="nav-item"><a class="nav-link " aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="product.php">Product</a></li>
                    
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

    <!-- Section-->
    <section class="my-5">
        <div class="container py-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
               
             <?php foreach($data as $i){ ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <div style="width:240px; max-height:240px;overflow:hidden;object-fit:cover;">
                        <img class="card-img-top" src="<?php echo $i['pic'] ; ?>" width="100%;" />
                        </div>
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $i['name'] ; ?></h5>
                                <!-- Product price-->
                                <h6>To Grab this Product Exchange <br><b><?php echo $i['exchange'] ; ?></b> old cloths</h6>
                                <p><?php echo $i['des'] ; ?></p>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="exchangefrom.php?odrid=<?php echo $i['pid'] ?>">Grab Now</a></div>
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-2 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; 2022</p>
        </div>
    </footer>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>