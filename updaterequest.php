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
    
    if(isset($_GET['update_id2'])){
        $update_id2 = $_GET['update_id2'];
        $sql = "SELECT * FROM exchangeform WHERE exchange_id  = '$update_id2' ";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
    }
   

   
   
    $submit = $_POST['submit'];

    if (isset($submit)) {
        $status = $_POST['status'];
        $datepick = $_POST['datepick'];
        $exchangeid = $_POST['exchangeid'];
       
            $q = "UPDATE exchangeform SET status = '$status' , pick_date ='$datepick' WHERE exchange_id ='$exchangeid' ";

            if (mysqli_query($conn, $q)) {
                header("location:orderadminview.php?successmsg= Request Sent ! Go to profile to track");
            } else {
                echo "<script>alert('not inserted')</script>";
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
                        <?php if (isset($_SESSION['user'])) { ?>
                            <?php if(isset($_SESSION['is_admin'])){ ?>
                              <li class="nav-item">  <a href="admin.php"  class="nav-link">Admin Panel</a></li>
                            <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="profile.php"><b>Hello</b>, <?php echo $_SESSION['name'] ?></a> </li>
                            <li class="nav-item"><a class="nav-link" href="logout.php"> &nbsp;&nbsp;&nbsp;&nbsp;| logout</a></li>

                            <form style="margin-left:30px">
                             <a class="btn" href="card.php">
                                    <i class="bi-cart-fill me-1"></i>
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

        <section style="height:100vh;overflow-y:scroll ;">
            <div class="container small-form">
                <?php if(isset($_GET['errormsg'])){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $_GET['errormsg'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }?>

                <?php if(isset($_GET['successmsg'])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> <?php echo $_GET['successmsg'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }?>

                <div class="card-body  text-black">
                    <h3 class=" text-uppercase">Update Status & pick up Date</h3>
                    <form method="post" action="updaterequest.php">
                        <div class="form-outline mb-2">
                            <select id="form3Example97" name="status" class="form-control form-control-lg" >
                                <option value="pending" <?php if($row['status']=='pending'){ echo "selected";} ?> >pending</option>
                                <option value="accepted" <?php if($row['status']=='accepted'){ echo "selected";} ?> >accepted</option>
                                <option value="on the Way" <?php if($row['status']=='on the Way'){ echo "selected";} ?> >on the Way</option>
                                <option value="picked" <?php if($row['status']=='picked'){ echo "selected"; } ?> >picked</option>
                                <option value="done" <?php if($row['status']=='done'){ echo "selected";} ?> >Done</option>
                            </select>
                            <label class="form-label" for="form3Example97">Status</label>
                        </div>
                      
                        <div class="col-md-6 mb-2">
                                <div class="form-outline">
                                    <input type="date" value="<?php echo $row['pick_date']; ?>" id="form3Example1n" name="datepick" style="width:200%;" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1n">Date to Pickup</label>
                                </div>
                        </div>
                        <input type="hidden" name="exchangeid" value="<?php echo $row['exchange_id'] ;?>">
                          
                            

                        <div class="d-flex  pt-3">
                            <button type="submit" name="submit" style="width:200%;" class="btn btn-warning btn-lg ms-2">Submit form</button>
                        </div>
                    </form>
                </div>





            </div>
        </section>

        
    <?php } else { ?>
        header("location:index.php");
        exit();
    <?php } ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>