<?php
// include 'connection.php';
// session_start();
// $admin_id = $_SESSION['admin_name'];
// echo $admin_id;

// if (!isset($admin_id)) {
//     header('location: login.php');
//     exit();
// }

// if (isset($_POST['logout'])) {
//     session_destroy();
//     header('location: login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon -->
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
</head>
<body>
    <!-- Your admin panel content goes here -->
    <?php include 'admin_header.php';?>
</body>
</html>
