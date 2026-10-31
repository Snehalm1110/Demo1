<?php 
include("header.php");


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
</head>

<body>
    

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Product</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Product</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative text-center mb-5">Best Prices We Offer For Ice Cream Lovers</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3" class="cart">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.90</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/chocolateC.jpeg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Cone Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</butten>
                            <input type="hidden" name="Item_name" value="chocolate">
                            <input type="hidden" name="Price" value="90">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3" class="cart">
                            <div class="bg-primary mt-n5 py-3 center" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.80</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/product-2.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Mix Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Mix Ice-Cream">
                            <input type="hidden" name="Price" value="80">                        
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.70</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/product-3.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Vanilla Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Vanilla Ice-Cream">
                            <input type="hidden" name="Price" value="70">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.100</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/product-4.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">BlackBerry Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="BlackBerry Ice-Cream">
                            <input type="hidden" name="Price" value="100">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.110</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/product-5.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Strawberry Milkshake</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Strawberry Milkshake">
                            <input type="hidden" name="Price" value="110">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">rs.100</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/mango1.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Mango Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Mango Ice Cream">
                            <input type="hidden" name="Price" value="100">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.90</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/sitaphal.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Custred Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Custred Ice Cream">
                            <input type="hidden" name="Price" value="90">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">    
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.120</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/chocolate1.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Chocolate Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Chocolate Ice Cream">
                            <input type="hidden" name="Price" value="120">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.110</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/apple.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Apple Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Apple Ice Cream">
                            <input type="hidden" name="Price" value="110">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">rs.85</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/cherry.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Cherry Ice Cream</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Cherry Ice Cream">
                            <input type="hidden" name="Price" value="85">
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.100</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/mango-falooda.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Mango Falooda</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Mango Falooda">
                            <input type="hidden" name="Price" value="100">                   
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 pb-2">
                    <form action="managecart.php" method="POST">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0">Rs.120</h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <img class="rounded-circle w-100 h-100" src="img/faluda.jpg" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4">Falooda</h5>
                            <button type="submit" name="Add_to_cart" class="btn btn-sm btn-secondary" name="addtocart">Order Now</button>
                            <input type="hidden" name="Item_name" value="Falooda">
                            <input type="hidden" name="Price" value="120">   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index.html" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary">i</span>CREAM</h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    <a class="btn btn-outline-secondary btn-social mr-2" href="https://x.com/?lang=en"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="https://in.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-secondary btn-social" href="https://www.instagram.com/accounts/login/?hl=en"><i class="fab fa-instagram"></i></a>
                </div>
                
                <div class="col-12">
                    <p class="m-0"> All Rights Reserved.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary px-2 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>