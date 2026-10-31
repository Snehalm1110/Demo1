<?php
$con = mysqli_connect("localhost", "root", "", "icecream");

if (isset($_POST['reg'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Prepare SQL query
    $sql = "INSERT INTO registration(name, email, password, contact, address ) 
            VALUES('$name', '$email', '$password', '$contact', '$address')";

    // Execute query
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "<script>alert('Registration Successfully'); window.location.href = 'login1.php';</script>";
    } else {
        echo "<script>alert('Registration Failed'); window.location.href = 'registration.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link href="style1.css" rel="stylesheet">
</head>
<body>
    <div class="form-box">
        <div class="header-text">Registration Form</div>
        
        <!-- Start Form -->
        <form method="POST" action="registration.php">
            <input placeholder="Your Name" id="name" name="name" type="text" required>
            <input placeholder="Your Email" id="email" name="email" type="email" required>
            <input placeholder="Your Password" id="password" name="password" type="password" required>
            <input placeholder="Contact no." id="contact" name="contact" type="number" required>
            <input placeholder="Address" id="address" name="address" type="text" required>
            <input id="terms" name="terms" type="checkbox">
            <label for="terms"></label><span>Agree with <a href="#">Terms & Conditions</a></span>
            
            <button type="submit" class="reg_button" name="reg" href="login.php">Register</button>
        </form>
        <!-- End Form -->
    </div>

    <script src="script.js"></script>
</body>
</html>
