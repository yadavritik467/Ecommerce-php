<?php
include 'connection.php';
session_start();
$user_id = $_SESSION['user_name'];



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
    <link rel="stylesheet" href="style.css">
    <title>Ecommerce - APP</title>
</head>

<body>


<nav> 
<p>Username : <span>
                    <?php echo $_SESSION['user_name']?>
                </span></p>
                <p>Email : <span>
                    <?php echo $_SESSION['user_email']?>
                </span></p>
                <form action="" method="post">
                    <button type="submit" name="logout" class="logout-btn">Logout</button>
                </form>

</nav>
</body>

</html>