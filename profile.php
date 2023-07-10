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
    include "conn.php";
    $email = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE email = '$email' ";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) === 1) {
        $row = mysqli_fetch_assoc($res);
    }

    $cuid = $_SESSION['id'];
    $sql2 = "SELECT * FROM exchangeform WHERE user_id ='$cuid' ";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        $data2 = array();
        while ($rows = mysqli_fetch_assoc($result2)) {
            $data2[] = $rows;
        }
    }

    if (isset($_GET['delete_id2'])) {
        $delete_id2 = $_GET['delete_id2'];
        $sql2 = "DELETE FROM exchangeform WHERE exchange_id  = '$delete_id2' ";
        $result = mysqli_query($conn, $sql2);
        if ($result) {
            header("location:profile.php?msg2=Deleted Successfully");
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
                        <li class="nav-item"><a class="nav-link " aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="product.php">Product</a></li>
                       
                    </ul>

                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <?php if (isset($_SESSION['user'])) { ?>
                                <?php if (isset($_SESSION['is_admin'])) { ?>
                                    <li class="nav-item"> <a href="admin.php" class="nav-link">Admin Panel</a></li>
                                <?php } ?>
                                <li class="nav-item"><a class="nav-link" href=""><b>Hello</b>, <?php echo $_SESSION['name'] ?></a> </li>
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


        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 profile-info">
                    <div class="pro-pic-bx">
                        <img src="images/avatar.jpg" alt="">
                    </div>
                    <h3>Hello <span><?php echo $row['first_name']; ?></span></h3>
                    <p>Name: <?php echo $row['first_name'] . " " . $row['last_name']; ?><br><?php echo $row['email']; ?> <br>Gender : <?php echo $row['gender']; ?></p>


                    <a href="logout.php" class="btn btn-outline-light">logout</a>
                    <form action="edit_profile.php" method="post" style="display:inline-block;">
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="user_id">
                        <input type="submit" class="btn btn-warning" value="Edit Proflie">
                    </form>
                </div>

                <div class="col-lg-9 mt-5 pt-5">
                    <?php if (isset($_GET['msg2'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Messages</strong> <?php echo $_GET['msg2']; ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <h6>YOUR ORDERS</h6>
                    <hr>
                    <?php if (empty($data2)) {  ?>
                        <div style="text-align:center;margin-top:100px">
                        <p>No orders yet <br>
                        Go to product and grab deals </p>
                        <a href="product.php" class="btn btn-warning">Shopping</a>
                        </div>
                    <?php } else { ?>
                        <table class="table">
                        <thead>
                                <tr>
                                    <th scope="col">#OrderId</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">address</th>
                                    <th scope="col">city</th>
                                    <th scope="col">zip Code</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">status</th>
                                    <!-- <th scope="col">Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data2 as $row) { ?>
                                    <tr>
                                    <td><?php echo "ODR".$row['exchange_id']; ?></td>
                                        <td>
                                            <?php
                                             $prodid = $row['prod_id'];
                                             $myq = "SELECT * FROM product WHERE pid ='$prodid' ";
                                             $result3 = mysqli_query($conn,$myq);
                                             if($result3){
                                                $pdata = mysqli_fetch_assoc($result3);
                                             }
                                             echo $pdata['name'];
                                            ?>
                                        </td>
                                        <td> <img src="<?php echo $pdata['pic']; ?>" style="max-width:50px"></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                        <td><?php echo $row['zip_code']; ?></td>
                                        <td><?php echo $row['pick_date']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <!-- <td>
                                            <a href="profile.php?delete_id2=<?php echo $row['exchange_id'] ?>" class="btn btn-outline-danger">Delete</a>
                                        </td> -->
                                    </tr>
                                <?php } ?>

                            <?php } ?>
                            </tbody>
                        </table>

                </div>
            </div>
        </div>




    <?php } else {
        header("location:index.php");
        exit();
    } ?>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>