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

// for wishlist
if(isset($_POST['add_to_wishlist'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $wishlist_number = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE name = '$product_name' AND 
    user_id = '$user_id'") or die("query failed");

    if(mysqli_num_rows($wishlist_number)>0){
        $message[] ='product already exists in wishlist';
    }
   else{
        mysqli_query($conn,"INSERT INTO `wishlist`(`user_id`,`pid`,`name`,`price`,`image`)VALUES('$user_id','$product_id','$product_name','$product_price','$product_image')");
        $message[] = 'product added in wishlist';
    }
}

 // for cart
if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_POST['product_image'];

    $cart_number = mysqli_query($conn,"SELECT * FROM `cart` WHERE name = '$product_name' AND 
    user_id = '$user_id'") or die("query failed");

if(mysqli_num_rows($cart_number)>0){
    $message[] ='product already exists in cart';
}else{
    mysqli_query($conn,"INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`)VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
    $message[] = 'product added in wishlist';
}
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
    <title>VEGGEN -HOME PAGE</title>
</head>

<body>
<?php  include 'header.php'; ?>

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

<!-- -----------------home slider --------------------- -->
<div class="container-fluid">
    <div class="hero-slider">
        <div class="slider-item">
            <img src="https://cdn.pixabay.com/photo/2019/10/11/12/19/hair-care-4541744_1280.jpg" alt="">
            <div class="slider-caption">
                <span>Test The Quality</span>
                <h1>Organic Premium <br>Honey</h1>
                <p>Enjoy sweet, aromatic honey made by hardworking people <br> ecologically clean raw  materials in the 
            
            most pure environment !</p>
            <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </div>
        <div class="slider-item">
            <img src="https://cdn.pixabay.com/photo/2022/08/19/04/30/shoes-7396101_640.jpg" alt="">
            <div class="slider-caption">
                <span>Test The Quality</span>
                <h1>Organic Premium <br>Honey</h1>
                <p>Enjoy sweet, aromatic honey made by hardworking people <br> ecologically clean raw  materials in the 
            
            most pure environment !</p>
            <a href="shop.php" class="btn">Shop Now</a>
            </div>
        </div>
    </div>
    <div class="controls">
        <i class="bi bi-chevron-left prev"></i>
        <i class="bi bi-chevron-right next"></i>
    </div>
</div>
<div class="line2"></div>
<div class="services">
    <diw class="row">
        <div class="box">
        <img src="https://th.bing.com/th/id/OIP.7InUgTe-lHEQUV-OO-WQsQHaHa?w=248&h=186&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="">
        <div>
            <h1>Free Shipping Fast</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero, aut.</p>
        </div>
        </div>
        <div class="box">
        <img src="https://th.bing.com/th/id/OIP.nDsOurA1gWuKXTrTNRxmggHaFL?w=256&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="">
        <div>
            <h1>Money Back & Gurantee</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero, aut.</p>
        </div>
        </div>
        <div class="box">
        <img src="https://th.bing.com/th/id/OIP.t50zUlAA0LDJazH2Jke19QHaE8?w=262&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="">
        <div>
            <h1>Online Support 24/7</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero, aut.</p>
        </div>
        </div>
    </diw>
</div>

<div class="line2"></div>
<div class="story">
    <div class="row">
        <div class="box">
            <span>Our Story</span>
            <h1>Production of natural honey since 1990</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In pariatur necessitatibus tenetur maxime magni, dolorem libero eaque perferendis laboriosam cum delectus cupiditate fuga dolore praesentium earum quod. Obcaecati, odio qui vero doloribus accusamus voluptatem laudantium necessitatibus omnis delectus debitis accusantium sequi aliquam quaerat! Esse impedit nemo doloribus. Excepturi placeat numquam neque nisi. Omnis, praesentium sequi?</p>
            <a class="btn" href="shop.php">Shop Now</a>
        </div>
        <div class="box">
            <img src="https://media.istockphoto.com/id/520733611/photo/jar-of-honey-with-honeycomb.jpg?s=612x612&w=0&k=20&c=k7s6XnJvM1O3kLfy5XUn1M169j11Zcca9rFgvIBGkUE=" alt="">
        </div>
    </div>
</div>

<div class="line2"></div>

<!-- testimonial -->

<div class="line4"></div>
<div class="testimonial-fluid">
    <h1 class="title">What Our Customers Says !!</h1>
    <div class="testimonial-slider">
        <div class="testimonial-item-hide">
        <img src="" alt="">
        <div class="testimonial-caption">
            <span>Test The Quality 1</span>
            <h1>Organic Premium Honey</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui neque earum quas eius ducimus accusantium, explicabo corporis provident doloremque consectetur quasi ab temporibus eligendi minima.</p>
        </div>
        </div>
        <div class="testimonial-item-hide">
        <img src="" alt="">
        <div class="testimonial-caption">
            <span>Test The Quality 2</span>
            <h1>Organic Premium Honey</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui neque earum quas eius ducimus accusantium, explicabo corporis provident doloremque consectetur quasi ab temporibus eligendi minima.</p>
        </div>
        </div>
        <div class="testimonial-item-hide">
        <img src="" alt="">
        <div class="testimonial-caption">
            <span>Test The Quality 3</span>
            <h1>Organic Premium Honey</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Qui neque earum quas eius ducimus accusantium, explicabo corporis provident doloremque consectetur quasi ab temporibus eligendi minima.</p>
        </div>
        </div>
    </div>
    <div class="controls">
        <i class="bi bi-chevron-left prev1"></i>
        <i class="bi bi-chevron-right next1"></i>
    </div>
</div>

<div class="line2"></div>

<!-- discover section -->

<div class="discover">
    <div class="detail">
        <h1 class="title">Organic Honey Be Healthy </h1>
        <span>Buy Now And Save 30% Off !!</span>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus nihil necessitatibus praesentium, dolor minus omnis et provident rerum amet ad possimus sunt quasi, at suscipit asperiores voluptatem fugit magnam, sint neque quam sit blanditiis sequi.</p> <br>
        <a class="btn" href="shop.php">Discover Now</a>
    </div> <br>
    <div class="img-box">
        <img src="https://cdn.pixabay.com/photo/2017/01/06/17/49/honey-1958464_1280.jpg" alt="">
        <img src="https://cdn.pixabay.com/photo/2018/05/17/21/59/beeswax-candles-3409828_640.jpg" alt="">
        <img src="https://media.istockphoto.com/id/598241944/photo/honey-in-jar-and-bunch-of-dry-lavender.webp?b=1&s=612x612&w=0&k=20&c=dFdIOtzku7KAwjVjRKVxB7fXu2vdxDXkgGU5JMPE9UA=" alt="">
    </div>
</div>

<?php  include 'homeshop.php'; ?>

<div class="line2"></div>
<div class="newslatter">
    <h1 class="title">Join Our To Newslatter </h1>
    <p>Get 15% off your next order. Be the first one to learn about promotions special events, new arrivals and more.</p>
    <input type="text"name="" placeholder="Your Email Address">
    <button>Subscribe Now</button>
</div>
<div class="line2"></div>
<div class="client">
    <div class="box">
        <img src="" alt="">
    </div>
    <div class="box">
        <img src="" alt="">
    </div>
    <div class="box">
        <img src="" alt="">
    </div>
    <div class="box">
        <img src="" alt="">
    </div>
</div>

<?php  include 'footer.php'; ?>


<script src="script.js"></script>
<!-- <script src="script2.js"></script> -->
</body>

</html>