<?php 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <style>
        .bg-primary {
            background-color: #F195B2 !important; /* Example: Orange-Red color */
    }
    .text-primary{
        color: #F195B2 !important;
        }
    </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>cart</title>
    </head>
    <body>

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Shopping Cart</h1>
            <div class="d-inline-flex align-items-center text-white">
                
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Portfolio Start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
                <h1>My Cart</h1>
            </div>
            <div class="col-lg-8">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                    <th scope="col">serial No.</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Qyantity</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php
                       
                        if(isset($_SESSION['cart']))
                        {
                           foreach($_SESSION['cart'] as $key => $value)
                           {
                            $sr=$key+1;
                        
                            echo"
                                <tr>
                                    <th>$sr</td>
                                    <td>$value[Item_name]</td>
                                    <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
                                    <td>
                                        <form action='managecart.php' method='POST'>
                                            <input class='center iquantity' name='modQuantity' onchange='this.form.submit();' type='number' value='$value[Quantity]' min='1' max='10'>
                                            <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                        </form>
                                    </td>
                                    <td class='itotal'></td>
                                    <td>
                                        <form action='managecart.php' method='POST'>
                                            <button name='Remove_Item' class='btn btn-sm btn-outline-denger'>Remove</button>
                                            <input type='hidden' name='Item_name' value='$value[Item_name]'>
                                        </form>
                                    </td>
                                </tr>
                                ";
                           }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="border bg-light rounded p-4">
                    <h4>Grand Total:</h4>
                    <h4 class="text-right" id="gtotal"></h4>
                    <br>
                    <form action="purchase.php" method="POST">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Only Cash on Delivery
                            </label>
                        </div>
                        <br>
                            <button class="btn btn-primary btn-block" name="purchase"> Order Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>	
    <!-- Portfolio End -->

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
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0"> All Rights Reserved. </a>
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
    <script>
        var gt=0;
        var iprice=document.getElementsByClassName('iprice');
        var iquantity=document.getElementsByClassName('iquantity');
        var itotal=document.getElementsByClassName('itotal');
        var gtotal=document.getElementById('gtotal');
        function subTotal()
        {
            gt=0;
            for(i=0;i<iprice.length;i++)
            {
                itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);

                gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            gtotal.innerText=gt;
        }

        subTotal();

    </script>
</body>

</html>