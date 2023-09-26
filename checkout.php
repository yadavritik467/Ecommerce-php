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


if(isset($_POST['order_btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $method = $_POST['method'];
    $address = 'flat no.' '$_POST['flat']';
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

    <div class="checkout-form">
        <h1 class="title">Payment process</h1>
        <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="message">
                <span>'.$message.'</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>
                ';
            }
        }
        ?>

        <div class="display-order">
            <div class="box-container">

           
            <?php 
            $select_cart = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id' ")
            or die('query failed');
            $total = 0;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart)>0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                    $grand_total = $total += $total_price; 
               
            ?>

           
                    <div class="box">
                        <img src="image/<?php echo $fetch_cart['image'];?>">
                        <!-- <span><?= $fetch_cart['name'];?> (<?= $fetch_cart['quantity']?>) </span> -->
                        <span>Name: <?php echo $fetch_cart['name'];?></span>
                        <span>Quantity: <?php echo $fetch_cart['quantity'];?></span>
                    </div>
           
            <?php 
             }
            }
            ?>
            </div>
            <span class="grand-total">Total Amount Payable : $<?= $grand_total; ?></span>
        </div>
        <form method="post">
            <div class="input-field">
                <label >Your Name</label>
                <input type="text" name="name" placeholder="Enter your name">
            </div>
            <div class="input-field">
                <label >Your Name</label>
                <input type="text" name="name" placeholder="Enter your name">
            </div>
            <div class="input-field">
                <label >Your Number</label>
                <input type="text" name="number" placeholder="Enter your number">
            </div>
            <div class="input-field">
                <label >Your Email</label>
                <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="input-field">
                <label >Select payment method</label>
                <select name="method" >
                    <option selected disabled>Select payment method</option>
                    <option value="cash on delivery">Cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paytm">paytm</option>
                    <option value="paypal">paypal</option>
                </select>
            </div>
            <div class="input-field">
                <label >Address line 1</label>
                <input type="text" name="flat" placeholder="e.g. flat no.">
            </div>
            <div class="input-field">
                <label >Address line 2</label>
                <input type="text" name="flat" placeholder="e.g. street name">
            </div>
            <div class="input-field">
                <label >City</label>
                <input type="text" name="city" placeholder="e.g. delhi">
            </div>
            <div class="input-field">
                <label >state</label>
                <input type="text" name="flat" placeholder="e.g. new delhi">
            </div>
            <div class="input-field">
                <label >country</label>
                <input type="text" name="flat" placeholder="e.g. India">
            </div>
            <div class="input-field">
                <label >pin code</label>
                <input type="text" name="flat" placeholder="e.g. 496001">
            </div>
            <input type="submit" name="order-btn" class="btn" value="order now">
        </form>

       
      
    </div>


    <div class="line2"></div>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="script2.js"></script> -->
</body>

</html>