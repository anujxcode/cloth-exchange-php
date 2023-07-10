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

    if(isset($_POST['addproduct']) && isset($_FILES['prodimg'])){
        $prodname = $_POST['prodname'];
        $des = $_POST['descrip'];
        $ex = $_POST['exchangeitems'];
        $prodimg = $_FILES['prodimg'];
        $prodimg_name = $prodimg['name'];
        $tmp_name = $prodimg['tmp_name'];

        $prodimgnamelc = strtolower($prodimg_name);
        $newimgname = uniqid("IMG-",true).'.'.$prodimgnamelc;
        $img_upload_path = 'media/product_img/'.$newimgname;
        move_uploaded_file($tmp_name,$img_upload_path);

        $sql="INSERT INTO product(name,exchange,des,pic) VALUES('$prodname','$ex','$des','$img_upload_path') ";
        $res = mysqli_query($conn,$sql);
        if($res){
            header("location:productupload.php?successmsg=Uploaded Successfully");
        }else{
            header("location:productupload.php?successmsg=Faild to upload");
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
            <li class="nav-item active">
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
            <li class="nav-item">
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
                <section>
                <!-- dashbaord -->
                <div class="container" >
                    <?php if(isset($_GET['msg'])){ ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Messages</strong> <?php echo $_GET['msg'] ; ?>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } ?>

                    <section>
            <div class="container small-form">
                <?php if(isset($_GET['ermsg'])){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $_GET['ermsg'] ; ?>
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
                    <h3 class=" text-uppercase">Add Product</h3>
                    <p class="mb-4" style="font-size:17px;">Hi, <b><?php echo $_SESSION['name'] ;?></b>  Upload products</p>
                    <form action="productupload.php" method="post" enctype="multipart/form-data">
                        
                        <div class="form-outline mb-2">
                            <input type="text" id="form3Example97" required name="prodname" class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">Product Name</label>
                        </div>
                        <div class="form-outline mb-2">
                            <input type="text" id="form3Example97" name="descrip" required class="form-control form-control-lg" />
                            <label class="form-label" for="form3Example97">description</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-outline">
                                    <input type="text" id="form3Example1m" required name="exchangeitems" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1m">Exchage items</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-outline">
                                    <input type="file" id="form3Example1n" required accept="image/jpeg , image/png"  name="prodimg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1n">Product Image</label>
                                </div>
                            </div>
                           
                        </div>

                        <!-- <div class="col-md-6 mb-2">
                                <div class="form-outline">
                                    <input type="file" id="form3Example1n" name="datepick" style="width:200%;" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example1n">Upload Image</label>
                                </div>
                        </div> -->
                          
                            

                        <div class="d-flex  pt-3">
                            <button type="submit" name="addproduct" style="width:200%;" class="btn btn-warning btn-lg ms-2">Submit form</button>
                        </div>
                    </form>
                </div>





            </div>
        </section>
               
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