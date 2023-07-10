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
    include('conn.php');


    $submit = $_POST['submit'];

    if (isset($submit)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
       


        function is_valid($var)
        {
            if (empty($var)) {
                return false;
            } else if (!ctype_alpha($var)) {
                return false;
            } else {
                return true;
            }
        }

        if (!is_valid($fname)) {
            header("location:signup.php?errormsg=Plase Enter  Valid First Name");
            exit();
        } else if (!is_valid($lname)) {
            header("location:signup.php?errormsg=Plase Enter Valid Last Name");
            exit();
        } else if (!is_valid($gender)) {
            header("location:signup.php?errormsg=Plase Enter Valid Gender Name");
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location:signup.php?errormsg=Plase Enter Valid Email");
            exit();
        } else if (empty($password)) {
            header("location:signup.php?errormsg=Plase Enter Password");
            exit();
        }
        else if($password != $cpassword){
            header("location:signup.php?errormsg=Confirm Password Not match !");
        } 
        else {
            $q = "INSERT INTO users(first_name,last_name,email,gender,password) VALUES('$fname','$lname','$email','$gender','$password')";
            if (mysqli_query($conn, $q)) {
                header("location:login.php?successmsg=Signup Successs !");
            } else {
                echo "<script>alert('not inserted')</script>";
            }
        }
    }
    ?>



    <?php if (isset($_SESSION['user'])) {
        header("location:index.php");
        exit();
    } else { ?>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html" style="font-weight:600 ;">Clothes <span style="color:#835353;"> Exchange</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                        </ul>
                       
                    </div>
                </div>
            </div>
        </nav>

        <section>
            <div class="container small-form">
                <?php if(isset($_GET['errormsg'])){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $_GET['errormsg'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }?>

                <div class="card-body  text-black">
                    <h3 class="mb-5 text-uppercase">registration</h3>
                    <form action="signup.php" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-outline">
                                    <input type="text" id="form3Example1m" name="fname" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1m">First name</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-outline">
                                    <input type="text" id="form3Example1n" name="lname" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1n">Last name</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="text" id="form3Example97" name="email" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">Email ID</label>
                        </div>

                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                            <h6 class="mb-0 me-3">Gender: </h6>

                            <div class="form-check form-check-inline mb-0 me-4">
                                <input class="form-check-input" type="radio" value="female" name="gender" id="femaleGender" />
                                <label class="form-check-label" for="femaleGender">Female</label>
                            </div>

                            <div class="form-check form-check-inline mb-0 me-4">
                                <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" />
                                <label class="form-check-label" for="maleGender">Male</label>
                            </div>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example97" name="password" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">Password</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example97" name="cpassword" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">Confirm Password</label>
                        </div>

                        <div class="d-flex  pt-2">
                            <button type="submit" name="submit" style="width: 200%;" class="btn btn-warning btn-lg ms-2">Submit form</button>
                        </div>
                    </form>
                </div>





            </div>
        </section>



    <?php } ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>