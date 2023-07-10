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

<body style="overflow-y:hidden ;">

    <?php
    session_start();
    include('conn.php');
    $email_id = $_SESSION['user'];
    $sql = "SELECT id FROM users WHERE email = '$email_id' ";
    $res = mysqli_query($conn, $sql);
    $userid = mysqli_fetch_assoc($res);


    if(isset($_GET['odrid'])){
        $prod_id = $_GET['odrid'];
        $sql = "SELECT * FROM product WHERE pid = '$prod_id'";
        $result = mysqli_query($conn, $sql);
        $prod = mysqli_fetch_assoc($result);
    }
   


    $submit = $_POST['submit'];

    if (isset($submit)) {
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];
        $datepick = $_POST['datepick'];
        $user_id = $_POST['user_id'];
        $prod_id = $_POST['prod_id'];


        function is_valid($var)
        {
            if (empty($var)) {
                return false;
            } else {
                return true;
            }
        }

        if (!is_valid($address)) {
            header("location:signup.php?errormsg=please enter address");
            exit();
        } else if (!is_valid($phone)) {
            header("location:signup.php?errormsg=Plase Enter Valid Phone");
            exit();
        } else if (!is_valid($city)) {
            header("location:signup.php?errormsg=Plase Enter city");
            exit();
        } else if (empty($zipcode)) {
            header("location:signup.php?errormsg=Plase zip code");
            exit();
        } else if (empty($user_id)) {
            header("location:signup.php?errormsg=somthing went wrong");
            exit();
        } else {
            $q = "INSERT INTO exchangeform(user_id,prod_id,address,phone,city,zip_code,pick_date) VALUES('$user_id','$prod_id','$address','$phone','$city','$zipcode','$datepick')";

            if (mysqli_query($conn, $q)) {
                header("location:profile.php?successmsg= Request Sent ! Go to profile to track");
            } else {
                echo "<script>alert('not inserted')</script>";
            }
        }
    }
    ?>



    <?php if (isset($_SESSION['user'])) { ?>

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
                        <?php if (isset($_SESSION['is_admin'])) { ?>
                            <li class="nav-item"> <a href="admin.php" class="nav-link">Admin Panel</a></li>
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

<section>
    <div class="container">
        <div class="row mt-5 d-flex align-items-center">
            <div class="col-lg-6" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px; padding:50px;border-radius:12px;">
                <div class="ml-5">
                    <div class="row">
                        <div class="col-lg-6" style="background:#f4f4f4;overflow:hidden;max-width:300px;">
                            <img src="<?php echo $prod['pic']; ?>" >
                        </div>
                        <div class="col-lg-6">
                            <h3><?php echo $prod['name']; ?></h3>
                            <p>Please Prepare <b><?php echo $prod['exchange']; ?></b> Cloths to grab this deal</p>
                            <p>we will come to your place to deliver this product and grab your old cloths</p>
                            <p><b>NOTE:</b> Please Fill the From Currectly</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="container" style="width:90%;margin:auto;transform:scale(.7)">
        <?php if (isset($_GET['errormsg'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?php echo $_GET['errormsg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if (isset($_GET['successmsg'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?php echo $_GET['successmsg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="card-body  text-black">
            <h3 class="text-uppercase">Fill Details</h3>
            <p class="mb-4" style="font-size:17px;">Hi, <b><?php echo $_SESSION['name']; ?></b> In order to grab the deal must fill this form</p>
            <form action="exchangefrom.php" method="post">

                <div class="form-outline mb-1">
                    <input type="hidden" id="form3Example97" name="user_id" value="<?php echo $userid['id']; ?>" class="form-control form-control-lg" />
                </div>
                <div class="form-outline mb-1">
                    <input type="text" id="form3Example97" name="address" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example97">Address</label>
                </div>
                <div class="form-outline mb-1">
                    <input type="text" id="form3Example97" name="phone" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Example97">Phone</label>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-1">
                        <div class="form-outline">
                            <input type="text" id="form3Example1m" name="city" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example1m">City</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-outline">
                            <input type="text" id="form3Example1n" name="zipcode" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example1n">Zip Code</label>
                        </div>
                    </div>

                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-outline">
                        <input type="date" id="form3Example1n" name="datepick" style="width:200%;" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example1n">Date to Pickup</label>
                    </div>
                </div>
                <input type="hidden" name="prod_id" value ="<?php echo $prod['pid'] ?>">
                <div class="d-flex  pt-3">
                    <button type="submit" name="submit" style="width:200%;" class="btn btn-warning btn-lg ms-2">Submit form</button>
                </div>
            </form>
        </div>
    </div>
            </div>
        </div>
    </div>
    
</section>




<?php } else { ?>
    <?php header("location:login.php"); ?>
<?php } ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>

</html>