<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: login.php');
    // exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    // exit();
}


//  for messaging 
if(isset($_POST['submit-btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

   $select_message = mysqli_query($conn,"SELECT * FROM `message` WHERE name ='$name' AND email ='$email' AND number ='$number' AND message ='$message'") or die ('query failed'); 

   if(mysqli_num_rows($select_message)>0){
    echo 'message already send';

   }else{
    mysqli_query($conn,"INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES ('$user_id','$name','$email','$number','$message')") or die('query failed');
    echo ' <script>
    alert("message sent successfully !! 😄")
    </script>';
   }

 

}



?>

<style type="text/css">
<?php include 'style.css';
?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Document</title>
    <style>  <?php  include 'style.css'; ?></style>
</head>


<body>
  
    <?php  include 'header.php'; ?>


    <div class="banner">
        <div class="detail">
            <h1>Order</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis
                esse!</p>
            <a href="index.php">Home </a> /<span>order</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="order-section">
        <div class="box-container">
            <?php 
            $select_orders = mysqli_query($conn,"SELECT * FROM `order` WHERE user_id='$user_id'") or die('query failed');
            if(mysqli_num_rows($select_orders)>0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
               
            ?>
           <div class="box">
            <p>Placed on : <span><?php echo $fetch_orders['placed_on'];?></span></p>
            <p>Name : <span><?php echo $fetch_orders['name'];?></span></p>
            <p>Number : <span><?php echo $fetch_orders['number'];?></span></p>
            <p>Email : <span><?php echo $fetch_orders['email'];?></span></p>
            <p>Flat : <span><?php echo $fetch_orders['flat'];?></span></p>
            <p>Street : <span><?php echo $fetch_orders['street'];?></span></p>
            <p>Street : <span><?php echo $fetch_orders['street'];?></span></p>
            <p>City : <span><?php echo $fetch_orders['city'];?></span></p>
            <p>Country : <span><?php echo $fetch_orders['country'];?></span></p>
            <p>Pincode : <span><?php echo $fetch_orders['pincode'];?></span></p>
            <p>Payment method : <span><?php echo $fetch_orders['method'];?></span></p>
            <p>Your order : <span><?php echo $fetch_orders['total_products'];?></span></p>
            <p>Total price : <span><?php echo $fetch_orders['total_price'];?></span></p>
            <p>Payment status : <span><?php echo $fetch_orders['payment_status'];?></span></p>
           </div>
            <?php 
             }
            }else {
                echo '<div class="empty">
                <p>No orders yet !!</p>
                </div>';
            }
            ?>
        </div>
    </div>


    <div class="line2"></div>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="script2.js"></script> -->
</body>

</html>