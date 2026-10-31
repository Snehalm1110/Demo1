<?php 
  session_start();
  $con=mysqli_connect("localhost","root","","icecream");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
    
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['purchase']))
    {
        $order_id=mysqli_insert_id($con);
        $query1="INSERT INTO `user_order`(`order_id`, `Item_name`, `Price`, `Quantity`) VALUES (?,?,?,?)";
        $stmt=mysqli_prepare($con,$query1);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt,"isii",$order_id,$Item_name,$Price,$Quantity);
            foreach($_SESSION['cart'] as $key => $values)
            {
              $Item_name=$values['Item_name'];
              $Price=$values['Price'];
              $Quantity=$values['Quantity'];
              mysqli_stmt_execute($stmt);
            }
            unset($_SESSION['cart']);
            echo " <script>alert('Order Placed');
              window.location.href = 'index.php';
              </script>";
        }
        else
        {
          echo " <script>
            alert('SQL Prepare Error');
            window.location.href = 'index.php';
            </script>";
        }
    }
}

?>