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
    

    mysqli_query($conn,"DELETE FROM `order`WHERE id ='$delete_id'") or die ("query failed");
    $message[] = 'order deleted'; 
    
    header('location:admin_order.php');

}

// updating payment status

if(isset($_POST['update_order'])){
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn,"UPDATE `order` SET payment_status = '$update_payment' WHERE id='$order_id' ") or die('query failed');

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
        <h1 class="title">Total orders</h1>
        <div class="box-container">
            <?php 
              $select_orders = mysqli_query($conn,"SELECT * FROM `order`") or die("query failed");
              if(mysqli_num_rows($select_orders)>0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){

                    echo '
                    <div class="box">
                        <p>User Id : <span>' . $fetch_orders['user_id'] . '</span></p>
                        <p>Name : <span>' . $fetch_orders['name'] . '</span></p>
                        <p>Placed on : <span>' . $fetch_orders['placed_on'] . '</span></p>
                        <p>Number : <span>' . $fetch_orders['number'] . '</span></p>
                        <p>Email : <span>' . $fetch_orders['email'] . '</span></p>
                        <p>Total price : <span>' . $fetch_orders['total_price'] . '</span></p>
                        <p>Method : <span>' . $fetch_orders['method'] . '</span></p>
                        <p>Flat : <span>' . $fetch_orders['flat'] . '</span></p>
                        <p>Street : <span>' . $fetch_orders['street'] . '</span></p>
                        <p>City : <span>' . $fetch_orders['city'] . '</span></p>
                        <p>Total product : <span>' . $fetch_orders['total_products'] . '</span></p>
                        <p>Payment Status : <span>' . $fetch_orders['payment_status'] . '</span></p>
                        <p>Payment Id : <span>' . $fetch_orders['payment_id'] . '</span></p>
                        <form method="post">
                        <input type="hidden" name="order_id" value="' . $fetch_orders['id'] . '">
                       <select name="update_payment">
                       <option disabled selected>' . $fetch_orders['payment_status'] . '</option>
                       <option value="pending">Pending</option>
                       <option value="complete">Complete</option>
                   </select>
                   <input type="submit" name="update_order" value="update payment" class="" > <br/>
                   <a class="delete" href="admin_order.php?delete=' . $fetch_orders['id'] . '"
                   onclick="return confirm(\'Delete this order?\');">Delete</a>
                   
                    </form>
                        </div>';

        }
        } else{
        echo '<div class="empty">
            <p> No order placed yet !! </p>
        </div>';
        }
        ?>
        </div>



    </section>



    <script src="script.js"></script>
</body>

</html>