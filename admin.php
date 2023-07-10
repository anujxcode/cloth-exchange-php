<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>
      <!-- Core theme CSS (includes Bootstrap)-->
      <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .myullist .nav-item a{
            margin:0 !important;
            padding:5px 20px  !important;
        }
        .myullist .nav-item a span{
            font-size: 20px !important;
            color:#999;
        }
        .myullist .active a span{
            color:#fff;
        }
        .myullist .nav-item a span .fab,
        .myullist .nav-item a span .fas{
            font-size: 20px !important;
            color:#999;
        }
    </style>

</head>

<body id="page-top">

    <?php
    session_start();
    include "conn.php";

    $sql = "SELECT * FROM users";
    $sql2 = "SELECT * FROM exchangeform";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);


    if (mysqli_num_rows($result) > 0) {
        $data = array();
        while ($rows = mysqli_fetch_assoc($result)) {
            $data[] = $rows;
        }
    }

    if (mysqli_num_rows($result2) > 0) {
        $data2 = array();
        while ($rows = mysqli_fetch_assoc($result2)) {
            $data2[] = $rows;
        }
    }

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM users WHERE id = '$delete_id' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location:admin.php?msg=Deleted Successfully");
        }
    }

    if (isset($_GET['delete_id2'])) {
        $delete_id2 = $_GET['delete_id2'];
        $sql2 = "DELETE FROM exchangeform WHERE exchange_id  = '$delete_id2' ";
        $result = mysqli_query($conn, $sql2);
        if ($result) {
            header("location:admin.php?msg2=Deleted Successfully");
        }
    }

    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion myullist" id="accordionSidebar" style="background:#333;">
            <div class="d-none d-md-inline mt-3 ml-3 ">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php"><span><i class="fas fa-home"></i> Home</span></a>
            </li>
            <hr class="sidebar-divider">
            <small style="padding-left:20px">PRODUCTS</small>
            <li class="nav-item">
                <a class="nav-link" href="productupload.php"><span><i class="fas fa-plus"></i> Add Products</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productadminview.php"><span><i class="fab fa-product-hunt"></i> View Product</span></a>
            </li>
            <hr class="sidebar-divider">
            <small style="padding-left:20px">ORDERS</small>
            <li class="nav-item">
                <a class="nav-link" href="orderadminview.php"><span><i class="fas fa-shopping-bag"></i> Orders</span></a>
            </li>

            <hr class="sidebar-divider">
            <small style="padding-left:20px">USERS</small>
            <li class="nav-item active">
                <a class="nav-link " href="admin.php"><span><i class="fas fa-users"></i> Users</span></a>
            </li>

            <div class="mt-5"></div>
            <hr class="sidebar-divider mt-5">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><span><i class="fas fa-sign-out-alt"></i> logout</span></a>
            </li>


            <!-- Divider -->
             

        </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <ul class="navbar-nav">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" style="display:flex;align-items:center;" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg" style="margin-right:20px ;">
                            <h5>Hello, <span  style="font-weight:bold;color:#333;">Admin</span> </h5> 
                            </a>
                        </li>
                </ul>
                  
                <!-- Topbar Navbar -->
                    
                </nav>
                <section  style="overflow-y:scroll;">
                <!-- dashbaord -->
                <div class="container" >
                    <?php if(isset($_GET['msg'])){ ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Messages</strong> <?php echo $_GET['msg'] ; ?>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } ?>
                    <div class="d-flex justify-content-between" id="userdetails">
                        <h4 style="font-weight:600 ;">User Details</h4>
                        <!-- <div>
                            <a href="signup.php" class="btn btn-outline-primary">Add User</a>
                        </div> -->
                    </div>
                    <hr>
                    <?php if (empty($data)) {  ?>
                        <div style="text-align:center;margin-top:100px">
                        <p>No request Yet <br>
                        Make a old cloth exchange Request </p>
                        <a href="exchangefrom.php" class="btn btn-warning">Exchange Now</a>
                        </div>
                    <?php } else { ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Password</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                foreach ($data as $row) { 
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $count++ ?></th>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-outline-success">Edit</a> -->
                                        <a href="admin.php?delete_id=<?php echo $row['id'] ?>" class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                       
                    </table>
                    <?php } ?>

                                
                     <!-- appointment -->
               
                </section>
               



            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>