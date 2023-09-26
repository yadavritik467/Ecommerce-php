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
            <h1>Contact</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis
                esse!</p>
            <a href="index.php">Home </a> /<span>contact</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="services">
    <div class="row">
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
    </div>
</div>


<div class="line2"></div>


    <div class="form-container-contact">
        <h1 class="title">
            leave a message
        </h1>
        <form method="post" action="">
         <div class="input-field">
            <label>Your Name</label> <br>
            <input type="text" name="name">
         </div>
         <div class="input-field">
            <label>Your Email</label> <br>
            <input type="email" name="email">
         </div>
         <div class="input-field">
            <label>Your Number</label> <br>
            <input type="number" name="number">
         </div>
         <div class="input-field">
            <label>Your Message</label> <br>
           <textarea name="message"></textarea>
         </div>
         <button type="submit" name="submit-btn">Send message</button>
        </form>
    </div>

    <div class="line2"></div>

    <div class="address">
        <h1 class="title">Our contact</h1>
        <div class="row">
           <div class="box">
           <i class="bi bi map-fill"></i>
           <div>
            <h4>Address</h4>
            <p>Darograpara , Masta gali,Raigarh ( C.G. )</p>
           </div>
           </div>
           <div class="box">
           <i class="bi bi telephone-fill"></i>
           <div>
            <h4>Phone number</h4>
            <p>+91 6260 380 884</p>
           </div>
           </div>
           <div class="box">
           <i class="bi bi envelope-fill"></i>
           <div>
            <h4>Email</h4>
            <p>yadavritik467@gmail.com</p>
           </div>
           </div>

        </div>
    </div>

    <div class="line2"></div>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="script2.js"></script> -->
</body>

</html>