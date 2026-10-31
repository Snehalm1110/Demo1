<?php
include ('header.php');
$con=mysqli_connect("localhost","root","","shop_db");
// if($con){
//     echo "connected";
// }
// else{
//     echo"not connected";
// }
if(isset($_POST['reg']))
{

 $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $mobileno=$_POST['mobileno'];
    $address=$_POST['address'];

    $sql="insert into registration(username,email,password,mobileno,address,date) values('$username','$email','$password','$mobileno','$address',CURDATE())";
    $res=mysqli_query($con,$sql);
   if($res){
    echo "<script>alert('Registration Successfully');
    window.location.href = 'login.php';
    </script>";
   }
   else{
    echo "<script>alert('Registration Failed');
    window.location.href = 'registration.php';
    </script>";
   }
}
   
?>
<body><br>
<div class="form-wrapper">
        <div class="reg-container">
            <h2 class="reg_h2"><b>Registration Form</b></h2>
            <form  method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email" class="reg_label">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password" class="reg_label">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="mobileno" class="reg_label">Mobile Number:</label>
                <input type="tel" id="mobileno" name="mobileno" required>

                <label for="address" class="reg_label">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>

                <button type="submit" class="reg_button" name="reg">Register</button>
            </form>
        </div>
    </div>
<br>


    <script src="script.js"></script>
</body>
</html>