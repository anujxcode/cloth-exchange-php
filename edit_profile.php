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

    if(isset($_POST['saveprofile'])){
        $update_id = $_POST['upid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];

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
        header("location:edit_profile.php?errormsg=Plase Enter  Valid First Name");
        exit();
    } else if (!is_valid($lname)) {
        header("location:edit_profile.php?errormsg=Plase Enter Valid Last Name");
        exit();
    } else if (!is_valid($gender)) {
        header("location:edit_profile.php?errormsg=Plase Enter Valid Last Name");
        exit();
    }  else if (empty($password)) {
        header("location:edit_profile.php?errormsg=Plase Enter Password");
        exit();
    } 
    else if(empty($update_id)){
        header("location:edit_profile.php?errormsg=can't update");
        exit();
    }
    else {
        $q = "UPDATE users SET first_name  = '$fname',last_name = '$lname', gender ='$gender', password = '$password'  WHERE id = '$update_id' ";

        if (mysqli_query($conn, $q)) {
            header("location:profile.php?successmsg=profile updated !");
            exit();
        } else {
            header("location:edit_profile.php?errormsg=not update Successs !");
            exit();
        }
    }
    }

    $user_id = $_POST['user_id'];
    $sqlQuery = "SELECT * FROM users WHERE id ='$user_id' ";
    $result = mysqli_query($conn, $sqlQuery);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
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
                        <li class="nav-item"><a class="nav-link " aria-current="page" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about">About</a></li>
                       
                    </ul>

                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                          
                        </ul>
                        <form style="margin-left:30px">
                             <a class="btn btn-outline-dark" href="order.php">
                                    Orders
                            </a>
                            </form>
                    </div>
                </div>
            </div>
        </nav>

        <section>
           
            <div class="container small-form">
                <?php if (isset($_GET['errormsg'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> <?php echo $_GET['errormsg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <div class="card-body  text-black">
                    <h3 class="mb-5 text-uppercase " style="margin-top:50px ;">Edit Profile</h3>
                    <p style="font-size:24px ;color:#333;font-weight:600;"><?php echo $row['email']; ?></p>
                    <form action="edit_profile.php" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="form3Example1m" value="<?php echo $row['first_name']; ?>" name="fname" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1m">First name</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="form3Example1n"  value="<?php echo $row['last_name']; ?>" name="lname" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1n">Last name</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-outline mb-4">
                            <input type="text" id="form3Example97" disabled   value="" name="email" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">Email ID</label>
                        </div> -->

                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                            <h6 class="mb-0 me-4">Gender: </h6>
                            <div class="form-check form-check-inline mb-0 me-4">
                                <input class="form-check-input" type="radio" <?php if($row['gender']=="female"){ echo"checked";} ?>  value="female" name="gender" id="femaleGender" />
                                <label class="form-check-label" for="femaleGender">Female</label>
                            </div>
                        
                            <div class="form-check form-check-inline mb-0 me-4">
                            <input class="form-check-input" type="radio" <?php if($row['gender']=="male"){ echo"checked";} ?> name="gender" id="maleGender" value="male" />
                                <label class="form-check-label" for="maleGender">Male</label>
                            </div>
                           

                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example97" name="password"  value="<?php echo $row['password']; ?>" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">Password</label>
                        </div>
                        <input type="hidden" name="upid" value="<?php echo $row['id'] ?>">
                        <div class="d-flex  pt-3">
                            <button type="submit" name="saveprofile" class="btn btn-warning btn-lg ms-2">Save Profile</button>
                            <a href="profile.php" class="btn btn-outline-dark" style="margin-left:20px ;"> Go Back</a>
                        </div>
                    </form>
                </div>





            </div>
        </section>
    <?php
    } else {
        header("location:index.html");
    }

    ?>



    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>