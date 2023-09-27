<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    echo '<script>
    window.location.href = "login.php";
    </script>';
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>
    window.location.href = "login.php";
    </script>';
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php  include 'header.php'; ?>


    <div class="banner">
        <div class="detail">
            <h1>Product detail</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis
                esse!</p>
            <a href="index.php">Home </a> /<span>About us</span>
        </div>
    </div>
    <div class="line2"></div>

    <section class="view_page">
        <?php 
 if(isset($message)){
  foreach($message as $message){
    echo '
    <div class="alert-message">
    <span>'.$message.'</span>
    <button onclick="this.parentElement.remove()" >X</button>
  </div>
    ';
  }
 }
?>       
            <?php 
            if(isset($_GET['pid'])){
                $pid = $_GET['pid'];
            $select_products = mysqli_query($conn,"SELECT * FROM `products` WHERE id = '$pid'") or ("query failed");

            if(mysqli_num_rows($select_products)>0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="box">
                <img src="image/<?php echo $fetch_products['image']?>"> <br>
               <div class="detail">
               <div class="price">$<?php echo $fetch_products['price']?></div>
                <div class="name"><?php echo $fetch_products['name']?></div>
                <div class="detail"><?php echo $fetch_products['product_details']?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']?>">
                
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']?>">
                <div class="icon">
                    <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                    <input type="number" name="product_quantity" value="1" min="1" max="100" class="quantity">
                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>
               </div>
            </form>
            <?php     
            }
        }
      }
            ?>
        
    </section>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="script2.js"></script> -->
</body>

</html>