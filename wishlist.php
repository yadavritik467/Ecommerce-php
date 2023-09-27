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


// for cart
if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = 1;
    $product_image = $_POST['product_image'];

    $cart_number = mysqli_query($conn,"SELECT * FROM `cart` WHERE name = '$product_name' AND 
    user_id = '$user_id'") or die("query failed");

if(mysqli_num_rows($cart_number)>0){
    $message[] ='product already exists in cart';
}else{
    mysqli_query($conn,"INSERT INTO `cart`(`user_id`,`pid`,`name`,`price`,`quantity`,`image`)VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
    $message[] = 'product added in cart';
}
}

// delete product from wishlist

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM `wishlist` WHERE id = '$delete_id'") or ("query failed");
    header("location:wishlist.php");
}
// delete all product from wishlist

if(isset($_GET['delete_all'])){
    $delete_id = $_GET['delete_all'];

    mysqli_query($conn,"DELETE FROM `wishlist` WHERE user_id = '$user_id'") or ("query failed");
    header("location:wishlist.php");
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
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>  <?php  include 'style.css'; ?></style>
</head>

<body>
  
    <?php  include 'header.php'; ?>


    <div class="banner">
        <div class="detail">
            <h1>My wishlist</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis
                esse!</p>
            <a href="index.php">Home </a> /<span>Wishlist</span>
        </div>
    </div>
    <div class="line2"></div>

    <section class="shop">
        <h1 class="title">product added in wishlist</h1>
        <?php 
 if(isset($message)){
  foreach($message as $message){
    echo '
    <div class="alert-message">
    <span>'.$message.'</span>
    <button onclick="this.parentElement.remove()" >X</button>
  </div>
    ';
  }
 }
?>
        
        <div class="box-container">
            <?php 
            $grand_total = 0;
            $select_wishlist =mysqli_query($conn, "SELECT * FROM `wishlist`") or die("query failed");
            if(mysqli_num_rows($select_wishlist)>0){
                while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){

            ?>
            <form method="post" class="box">
                <img src="image/<?php echo $fetch_wishlist['image']?>" >  <br>
                <div class="price">$<?php echo $fetch_wishlist['price']?></div>
                <div class="name"><?php echo $fetch_wishlist['name']?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id']?>" >
                <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']?>" >
                <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']?>" >
                <input type="hidden" name="product_quantity" value="1" min="1">
                <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']?>" >
                <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_wishlist['pid']?>" class="bi bi-eye-fill"></a>
                  <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id'] ?>" class="bi bi-x"
                  onclick="return confirm('You sure!! you want to delete this ?? ')"
                  ></a>
                    <button type="submit" name="add_to_cart" class="bi bi-cart" ></button>
                </div>
            </form>

            <?php 
            $grand_total +=$fetch_wishlist['price'];
               }
            }else{
                echo '<p class="empty">No products added yet !!</p>';
            }
            ?>
        </div>
        <div class="wishlist_total">
        <p>Total amount payable : <span>$<?php echo $grand_total;?></span></p>
        <a href="shop.php" class="btn">Continue shopping </a>
        <a href="wishlist.php?delete_all" class="btn" <?php echo ($grand_total)?'':'disabled' ?> onclick="return confirm('You sure!! you want to delete this all ?? ')">Delete All</a>
        </div>
    </section>
    <div class="line2"></div>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="script2.js"></script> -->
</body>

</html>