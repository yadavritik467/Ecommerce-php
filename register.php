<?php
include 'connection.php';

if(isset($_POST['submit-btn'])){
  $name = $_POST["name"];
  $number = $_POST["phone"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];

  $select_user = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

  if(mysqli_num_rows($select_user) > 0){
    $message[] = 'User already exists';
  }else{
    if($password != $cpassword){
      $message[] = 'Passwords do not match';
    }else{
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

      mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`, `number`) VALUES ('$name', '$email', '$hashedPassword', '$number')") or die("query failed");
       $message[] = 'Registered successfully';
       echo '<script>
    setTimeout(function() {
        window.location.href = "login.php";
    }, 1500); 
  </script>';
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon -->
    <link rel="stylesheet" href="style.css">
    <title>Register Page</title>
</head>

<body>


<section class="form-container">

<?php 
 if(isset($message)){
  foreach($message as $message){
    echo '
    <div class="message">
    <span>'.$message.'</span>
    <button onclick="this.parentElement.remove()" >X</button>
  </div>
    ';
  }
 }
?>

    <form action="" method="post">
        <h1>Register Now</h1>
        <input type="text" required name="name" placeholder="enter your name">
        <input type="number" required name="phone" placeholder="enter your number">
        <input type="text" required name="email" placeholder="enter your email">
        <input type="password" required name="password" placeholder="enter your password">
        <input type="password" required name="cpassword" placeholder="enter your confirm password">
        <input type="submit" name="submit-btn" value="register now" class="btn">
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </form>
</section>
</body>

</html>