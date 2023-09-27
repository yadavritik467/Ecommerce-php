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


<!-- <div class="banner">
        <div class="detail">
            <h1>About </h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis esse!</p>
            <a href="index.php">Home </a> /<span>About us</span>
        </div>
    </div> -->
   <div class="line2"></div>

   <!-- about us -->

   <div class="about-us">
    <div class="row">
        <div class="box">
            <div class="title">
                <span>ABOUT OUR ONLINE STORE</span>
                <h1>Hello, With 25 years of experience</h1>
            </div>
            <p>Over 25 years Ecommerce helping companies reach their financial and branding golas

            The perfect way to enjoy brewing tea on low hanging fruit to identify. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi omnis architecto earum voluptates neque repellat doloremque corporis fuga magni in. For me, the most important part of 
            improving at photography.
            </p>
        </div>
        <div class="img-box">
            <img src="https://cdn.pixabay.com/photo/2014/12/17/21/55/smartphone-571961_640.jpg" alt="">
        </div>
    </div>
   </div>

   <div class="line2"></div>
   <!----------features ---------------->

   <div class="features">
      <div class="title">
          <h1>Complete Customer Ideas</h1>
        <span>best features</span>
      </div>
     <div class="row">
     <div class="box">
        <img src="https://cdn.pixabay.com/photo/2018/08/17/15/29/call-3613071_640.png" alt="">
        <h4>24 X 7</h4>
        <p>Online support 24/7</p>
      </div>
      <div class="box">
        <img src="https://cdn.pixabay.com/photo/2016/10/26/15/08/seal-1771694_1280.png" alt="">
        <h4>Money Back Gurantee</h4>
        <p>100% Secure Payment</p>
      </div>
      <div class="box">
        <img src="https://media.istockphoto.com/id/1455291837/photo/gift-cards-with-red-colored-bow-on-red-background-stock-photo.webp?b=1&s=612x612&w=0&k=20&c=4Jc-fXlAaUtgbv4pZ5o8BYHgAd_6mHDn5GH1i7QPWWM=" alt="">
        <h4>Special Gift Card</h4>
        <p>Give The Perfect Gift</p>
     </div>
     <div class="box">
        <img src="https://cdn.pixabay.com/photo/2018/05/18/16/41/globe-3411506_1280.jpg" alt="">
        <h4>Worldwide Shipping</h4>
        <p>On Order Over $99</p>
      </div>
        <div class="box">
        <img src="https://cdn.pixabay.com/photo/2016/05/29/01/17/special-offer-1422378_640.png" alt="">
        <h4>Special offers</h4>
        <p>On continue shopping</p>
       </div>
       <div class="box">
        <img src="https://th.bing.com/th/id/OIP.PF6rCmFcEmklsBGXEanKUQHaB1?w=333&h=86&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="">
        <h4>Subscription</h4>
        <p>For the entertainment purpose</p>
        </div>
      </div>
   </div>

   <div class="line2"></div>
   <!--------------Team Section  ---------------->

   <div class="team">
    <div class="title">
        <h1>Our Workable Team</h1>
        <span>best team</span>
    </div>
    <div class="row">
        <div class="box">
            <div class="img-box">
                <img src="https://cdn.pixabay.com/photo/2017/09/27/15/57/man-2792505_640.jpg" alt="">
            </div>
            <div class="detail">
                <span>Finance Manager</span>
                <h4>Miguel Rodrigez</h4>
                <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="https://cdn.pixabay.com/photo/2017/08/26/11/18/model-2682792_640.jpg" alt="">
            </div>
            <div class="detail">
                <span>Finance Manager</span>
                <h4>Miguel Rodrigez</h4>
                <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="https://cdn.pixabay.com/photo/2017/11/02/14/26/model-2911329_640.jpg" alt="">
            </div>
            <div class="detail">
                <span>Finance Manager</span>
                <h4>Miguel Rodrigez</h4>
                <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="img-box">
                <img src="https://cdn.pixabay.com/photo/2017/06/03/04/46/man-2367953_640.jpg" alt="">
            </div>
            <div class="detail">
                <span>Finance Manager</span>
                <h4>Miguel Rodrigez</h4>
                <div class="icons">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-whatsapp"></i>
                </div>
            </div>
        </div>
    </div>
   </div>
   

<?php  include 'footer.php'; ?>


<script src="script.js"></script>
<!-- <script src="script2.js"></script> -->
</body>

</html>