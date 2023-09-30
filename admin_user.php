<?php
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_name'];



if (!isset($admin_id)) {
    header('location: login.php');
    // exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    // exit();
}

// adding products to database

if(isset($_POST['add_product'])){
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_detail = $_POST['detail'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/'.$image;

    $select_product_name = mysqli_query($conn,"SELECT name FROM `products` WHERE name= '$product_name'") or die('query failed');
    
    if(mysqli_num_rows($select_product_name)>0){
        $message[] = 'product name already exists';
    }else{
        $insert_product = mysqli_query($conn,"INSERT INTO `products`(`name`,`price`,`product_details`,`image`)
        VALUES ('$product_name','$product_price','$product_detail','$image')") or die('query failed');
        if($insert_product){
            if($image_size>2000000){
                $message[]='image size is too large';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[]='product added successfully';
            }
        }
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    

    mysqli_query($conn,"DELETE FROM `users`WHERE id ='$delete_id'") or die ("query failed");
    $message[] = 'user removed successfully'; 
    
    header('location:admin_user.php');

}

?>

<style type="text/css">
<?php 
   include 'style.css';
?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin Panel</title>
</head>

<body>
    <!-- Your admin panel content goes here -->
    <?php include 'admin_header.php';?>
    <?php 
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
            <span> '.$message.' </span>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"> </i>
            </div>
            ';
        }
    }
    ?>

    <div class="line4"></div>
    <div class="line4"></div>
    <section class="order-container">
        <h1 class="title">Total users accounts</h1>
        <div class="box-container">
            <?php 
              $select_users = mysqli_query($conn,"SELECT * FROM `users`") or die("query failed");
              if(mysqli_num_rows($select_users)>0){
                while($fetch_users = mysqli_fetch_assoc($select_users)){

                    echo '
                    <div class="box">
                        <p>User Id: <span>' . $fetch_users['id'] . '</span></p>
                        <p>Name: <span>' . $fetch_users['name'] . '</span></p>
                        <p>Email: <span>' . $fetch_users['email'] . '</span></p>
                        <p>Number: <span>' . $fetch_users['number'] . '</span></p>
                        <p>Role: ' . $fetch_users['user_type'] . '</p>
                        <a class="edit" href="admin_user.php?delete=' . $fetch_users['id'] . '" onclick="return confirm(\'Delete this user?\');">Delete</a>
                    </div>';

                }
              } else{
                echo '<div class="empty">
                <p> No users yet !! </p>
                </div>';
              }
            ?>
        </div>

        <

    </section>

  

    <script src="script.js"></script>
</body>

</html>