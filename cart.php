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


// updateing qty in cart 

if(isset($_POST['update_qty_btn'])){
    $update_qty_id = $_POST['update_qty_id'];
    $update_value = $_POST['update_qty'];

    // echo $update_value;

    $update_query = mysqli_query($conn,"UPDATE `cart` SET quantity = '$update_value' WHERE id='$update_qty_id'") or die('query failed');

    if($update_query){
        header('location:cart.php');
    }
}

// delete product from wishlist

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM `cart` WHERE id = '$delete_id'") or ("query failed");
    header("location:cart.php");
}
// delete all product from cart

if(isset($_GET['delete_all'])){
    $delete_id = $_GET['delete_all'];

    mysqli_query($conn,"DELETE FROM `cart` WHERE user_id = '$user_id'") or ("query failed");
    header("location:cart.php");
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
            <h1>My Cart</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis
                esse!</p>
            <a href="index.php">Home </a> /<span>cart</span>
        </div>
    </div>
    <div class="line2"></div>

    <section class="shop">
        <h1 class="title">product added in cart</h1>
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
            $select_cart =mysqli_query($conn, "SELECT * FROM `cart`") or die("query failed");
            if(mysqli_num_rows($select_cart)>0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){

            ?>
            <div method="post" class="box">
            <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_cart['pid']?>" class="bi bi-eye-fill"></a>
                  <a href="cart.php?delete=<?php echo $fetch_cart['id'] ?>" class="bi bi-x"
                  onclick="return confirm('You sure!! you want to delete this ?? ')"
                  ></a>
                    <button type="submit" name="add_to_cart" class="bi bi-cart" ></button>
                </div>
                <img src="image/<?php echo $fetch_cart['image']?>" >  <br>
                <div class="price">$<?php echo $fetch_cart['price']?></div>
                <div class="name"><?php echo $fetch_cart['name']?></div>
                <form action="" method="post">
                    <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id'];?>" >
                    <div class="qty">
                        <input type="number" name="update_qty" value="<?php echo $fetch_cart['quantity']?>" >
                        <input type="submit" name="update_qty_btn" value="update" >
                    </div>
                </form>
                <div class="total-amt">
                    Toatal Amount : <span><?php echo $total_amt = ($fetch_cart['price']*$fetch_cart['quantity']) ?></span>
                </div>
               
            </div>

            <?php 
            $grand_total +=$fetch_cart['price'];
               }
            }else{
                echo '<p class="empty">No products added yet !!</p>';
            }
            ?>
        </div>
        <div class="dlt">
        <a href="cart.php?delete_all" class="btn" <?php echo ($grand_total)?'':'disabled' ?> onclick="return confirm('You sure!! you want to delete this all ?? ')">Delete All</a>
        
        </div>
        <div class="wishlist_total">
        <p>Total amount payable : <span>$<?php echo $grand_total;?></span></p>
        <a href="shop.php" class="btn">Continue shopping </a>
        <a href="checkout.php" class="btn" <?php echo ($grand_total)?'':'disabled' ?>>Proceed to checkout</a>
        </div>
    </section>
    <div class="line2"></div>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="script2.js"></script> -->
</body>

</html>