<?php 
session_start();

$con=mysqli_connect("localhost","root","","icecream");

$name='';
$email='';
$message='';

if(isset($_POST['contact'])){

  $name=$_POST['name'];
  $email=$_POST['email'];
  $message=$_POST['message'];
   

    $sql1="insert into contact(name,email,message) values('$name','$email','$message')";
    $res1=mysqli_query($con,$sql1);
   if($res1){
    echo "<script>alert('Contact info sent successfully');
    window.location.href = 'index.php';
    </script>";
   }
   else{
    echo "<script>alert('Contact info failed to send');
    window.location.href = 'index.php';
    </script>";
   }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>iCREAM - Ice Cream Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <style>
        .bg-primary {
            background-color: #ff5733 !important; /* Example: Orange-Red color */
    }
        
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-right mb-2 mb-lg-0">   
                </div>
                    <div class="col-md-6 text-center text-lg-right">
                        <div class="d-inline-flex align-items-center">
                            <a class="text-white px-3" href="https://www.facebook.com/">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-white px-3" href="https://x.com/?lang=en">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-white px-3" href="https://in.linkedin.com/">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-white px-3" href="https://www.instagram.com/accounts/login/?hl=en">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="text-white pl-3" href="https://www.youtube.com/">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>CREAM</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="product.php" class="nav-item nav-link">Product</a>
                    </div>
                    <a href="index.php" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary">Unique <span class="text-secondary">i</span>CREAM</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="gallery.php" class="nav-item nav-link">Gallery</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                        <?php
                        if(isset($_SESSION['email']))
                        {
                        ?>
                        <a href="logout.php" class="nav-item nav-link">Logout</a>
                        <?php
                        }
                        else{
                        ?>
                        <a class="nav-item nav-link" href="login1.php">Login</a>
                        <?php
                        }
                        ?>
                        <?php 
                            $count=0;
                            if(isset($_SESSION['cart']))
                            {
                                $count=count($_SESSION['cart']);
                            }
                        ?>
                        <a href="shopcart.php" class="nav-item nav-link">Mycart(<?php echo $count; ?>)</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
