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
    $select_delete_image = mysqli_query($conn,"SELECT image FROM `products` WHERE id ='$delete_id'") or die ("query failed");
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn,"DELETE FROM `products`WHERE id ='$delete_id'") or die ("query failed");
    mysqli_query($conn,"DELETE FROM `cart`WHERE pid ='$delete_id'") or die ("query failed");
    mysqli_query($conn,"DELETE FROM `wishlist`WHERE pid ='$delete_id'") or die ("query failed");
    
    header('location:admin_product.php');

}

// update product

if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_detail = $_POST['update_detail'];
    $update_image = $_POST['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['name'];
    $update_image_folder = 'image/'.$update_image;

    $update_query = mysqli_query($conn,"UPDATE `products` SET `id`='$update_id',`name`='$update_name',`price`='$update_price',`product_details`='$update_detail',`image`='$update_image' WHERE id ='$update_id'") or die('query failed');
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

    <div class="line2"></div>
    <div class="line2"></div>
    <section class="add-products form-container">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="input-field">
                <label for="">Product name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label for="">Product Price</label>
                <input type="text" name="price" required>
            </div>
            <div class="input-field">
                <label for="">Product details</label>
                <textarea name="detail" require></textarea>
            </div>
            <div class="input-field">
                <label for="">Product image</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg,image/png, image/webp" required>
            </div>
            <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>
    <div class="line3"></div>
    <div class="line4"></div>
    <div class="show-products">
        <div class="box-container">
            <?php 
            $select_products = mysqli_query($conn,"SELECT * FROM `PRODUCTS`") or die("query failed");
            if (mysqli_num_rows($select_products)) {
                while($fetch_products = mysqli_fetch_assoc($select_products)){
                    echo '<div class="box">
                      <img src="image/' . $fetch_products['image'] . '">
                      <p>Price : '. $fetch_products['price'] .'</p>
                      <p>Name : '. $fetch_products['name'] .'</p>
                      <details> '. $fetch_products['product_details'] .'</details>
                      <a href="admin_product.php?edit=' . $fetch_products['id'] . '" class="edit" >Edit</a>
                      <a href="admin_product.php?delete=' . $fetch_products['id'] . '" class="delete" onclick="return confirm(\'Your really want to delete this product\');">Delete</a>

                    </div>';
                }
             
            } else {
                 echo '<div class="empty">
                    <p> No products added yet !! </p>
                    </div>';
            }
            
            ?>
        </div>
    </div>
    <div class="line"></div>
    <section class="update-container">
        <?php 
        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn,"SELECT * FROM `products`WHERE id= '$edit_id'") or die('query failed');
            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                    echo '<form action="" enctype="multipart/form-data" method="post">
                    <img src="image/' . $fetch_edit['update_image'] . '">
                    <input type="hidden" name="update_id" value="' . $fetch_edit['id'] . '">
                    <input type="text" name="update_name" value="' . $fetch_edit['name'] . '">
                    <input type="number" name="update_price" value="' . $fetch_edit['price'] . '">
                    <textarea name="update_details">' . $fetch_edit['product_details'] . '</textarea>
                    <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp">
                    <input type="submit" name="update_product" value="update" id="open-form" class="edit">
                    <input type="reset" name="" value="cancel" class="option-btn btn" id="close-form">
                </form>';
                }
            }
        }

        echo "<script>document.querySelector('.update-container').style.display='none'</script>";
        ?>

   

    </section>

    <script src="script.js"></script>
</body>

</html>