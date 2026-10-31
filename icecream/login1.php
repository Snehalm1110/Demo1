<?php  
session_start();  // Start the session

// Database connection
$con = mysqli_connect("localhost", "root", "", "icecream");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="select count(id)  from registration where email='$email' and password='$password'";
    $res=mysqli_query($con,$sql);
    $count=mysqli_fetch_row($res);
    if($count[0]=='1')
    {
        $_SESSION['email']=$email;
        echo " <script>alert('Login Successfully');
    window.location.href = 'index.php';
    </script>";

    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link href="style1.css" rel="stylesheet">
</head>
<body>
    <div class="form-box">
        <div class="header-text">
            Login Form
        </div>

        <!-- Form start -->
        <form method="POST" action="login1.php">
            <input placeholder="Your Email Address" name="email" type="email" required>  <!-- Change to 'email' type -->
            <input placeholder="Your Password" name="password" type="password" required>
            <div class="checkbox-container">
                
            </div>
            <button type="submit" class="reg_button" name="login">Login</button>
        </form>
        <!-- Form end -->

        <p>Not Registered?<a href="registration.php">Register</a></p>
    </div>
</body>
</html>
