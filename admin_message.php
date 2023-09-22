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
    

    mysqli_query($conn,"DELETE FROM `message`WHERE id ='$delete_id'") or die ("query failed");
    
    header('location:admin_message.php');

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
    <section class="message-container">
        <h1 class="title">unread message</h1>
        <div class="box-container">
            <?php 
              $select_message =mysqli_query($conn,"SELECT * FROM `message`") or die("query failed");
              if(mysqli_num_rows($select_message)>0){
                while($fetch_message = mysqli_fetch_assoc($select_message)){

                    echo '
                    <div class="box">
                        <p>User Id: <span>' . $fetch_message['id'] . '</span></p>
                        <p>Name: <span>' . $fetch_message['name'] . '</span></p>
                        <p>Email: <span>' . $fetch_message['email'] . '</span></p>
                        <p>Message: ' . $fetch_message['message'] . '</p>
                        <a class="edit" href="admin_message.php?delete=' . $fetch_message['id'] . '" onclick="return confirm(\'Delete this message?\');">Delete</a>
                    </div>';

                }
              } else{
                echo '<div class="empty">
                <p> No messages yet !! </p>
                </div>';
              }
            ?>
        </div>

        <

    </section>
   
    <div class="line"></div>
  

    <script src="script.js"></script>
</body>

</html>