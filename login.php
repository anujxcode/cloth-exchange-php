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
        include("conn.php");
        
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $q = "select * from users where email = '$email' and password ='$password' ";
            $result = mysqli_query($conn,$q);


            if(mysqli_num_rows($result) ===1 ){
                
                $row = mysqli_fetch_assoc($result);
                if($row['is_admin'] === '1'){
                    if($row['email'] === $email && $row['password'] ===$password){
                        $_SESSION['user'] = $row['email'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['is_admin'] = $row['is_admin'];
                        $_SESSION['name'] = $row['first_name'];
                        header("location:admin.php?successmsg=Welcome sir");
                        exit();
                    }
                }else{
                    if($row['email'] === $email && $row['password'] ===$password){
                        $_SESSION['user'] = $row['email'];
                        $_SESSION['name'] = $row['first_name'];
                        $_SESSION['gender'] = $row['gender'];
                        $_SESSION['id'] = $row['id'];
                    }
                    else{
                        header("location:login.php?errormsg=Invalid Username or Password");
                        exit();
                    }
                }
                
               
            }
            else{
                header("location:login.php?errormsg=Invalid Username or Password");
                exit();
            }
        }
    
    
    
    
    
    
    ?>
    <!-- Navigation-->

    <?php if(isset($_SESSION['user'])){
        header("location:index.php");
        exit();
    } else{?>

    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php" style="font-weight:600 ;">Clothes <span style="color:#835353;"> Exchange</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
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
<br><br><br>


    <section>
        <div class="container small-form " style="margin-top:100px;">

                 <?php if(isset($_GET['successmsg'])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $_GET['successmsg'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }?>
                 <?php if(isset($_GET['errormsg'])){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> <?php echo $_GET['errormsg'] ; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }?>
            <div class="card-body  text-black">
                <h3 class="mb-5 text-uppercase">Log in</h3>
                <form action="login.php" method="post">
                    
                    <div class="form-outline mb-4">
                        <input type="text" id="form3Example97" name="email" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example97">Email ID</label>
                    </div>

                  
                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example97" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example97">Password</label>
                    </div>

                    <p style="color:red;">
                
                    </p>
                    <div class="d-flex  pt-3">
                        <button type="submit" name="login" class="btn btn-warning btn-lg ms-2">login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

        <?php }?>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>