<?php
include 'connection.php';

session_start();

if(isset($_POST['submit-btn'])){
  $email = $_POST["email"];
  $password = $_POST["password"];

  $select_user = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

  if(mysqli_num_rows($select_user) > 0){
  $row = mysqli_fetch_assoc($select_user);
  
  if(password_verify($password,$row['password'])){
    if($row['user_type']=='admin'){
        $session['admin_name'] = $row['name'];
        $session['admin_email'] = $row['email'];
        $session['admin_id'] = $row['id'];
        $message[] = 'login successfully'; 
         // Redirect to the registration page with a delay of 3 seconds
    echo '<script>
    setTimeout(function() {
        window.location.href = "admin_pannel.php";
    }, 2000); 
  </script>';
        // header('location:admin_pannel.php');
      }else if($row['user_type']=='user'){
        $session['user_name'] = $row['name'];
        $session['user_email'] = $row['email'];
        $session['user_id'] = $row['id'];
        $message[] = 'login successfully'; 
        // Redirect to the registration page with a delay of 3 seconds
   echo '<script>
   setTimeout(function() {
       window.location.href = "index.php";
   }, 2000); 
 </script>';
        } else{
            $message[] = 'Please login to access this page'; 
        }
    }else{
        $message[] = 'Incorrect email or password'; 
         // Redirect to the registration page with a delay of 3 seconds
    echo '<script>
    setTimeout(function() {
        window.location.href = "register.php";
    }, 2000); 
  </script>';
  }
  
  }else {
    $message[] = 'Incorrect email or password'; 
         // Redirect to the registration page with a delay of 3 seconds
    echo '<script>
    setTimeout(function() {
        window.location.href = "register.php";
    }, 2000); 
  </script>';
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
            <h1>Login Now</h1>
            <input type="text" required name="email" placeholder="enter your email">
            <input type="password" required name="password" placeholder="enter your password">
            <input type="submit" name="submit-btn" value="login now" class="btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </section>
</body>

</html>