

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"></a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="shop.php">Shop</a>
                <a href="order.php">order</a>
                <a href="contact.php">contact</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <?php
                 $select_wishlist = mysqli_query($conn,"SELECT * FROM `wishlist`WHERE user_id= '$user_id'") or die("query failed");
                 $wishlist_num_rows = mysqli_num_rows($select_wishlist);


                ?>
                <a href="wishlist.php"> <i class="bi bi-heart" ></i> <sup><?php echo $wishlist_num_rows;?></sup> </a>
                <?php
                 $select_cart = mysqli_query($conn,"SELECT * FROM `cart`WHERE user_id= '$user_id'") or die("query failed");
                 $cart_num_rows = mysqli_num_rows($select_cart);


                ?>
                <a href="cart.php"> <i class="bi bi-cart" ></i>  <sup><?php echo $cart_num_rows;?></sup> </a>
                <i class="bi bi-list" id="menu-btn"></i>
                <!--put icons here -->
                <!--put icons here -->
            </div>
            <div class="user-box">
                <p>Username : <span>
                    <?php echo $_SESSION['user_name']?>
                </span></p>
                <p>Email : <span>
                    <?php echo $_SESSION['user_email']?>
                </span></p>
                <form action="" method="post">
                <button type="submit" name="logout" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <!-- <div class="banner">
        <div class="detail">
            <h1>Admin dashboard</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis esse!</p>
        </div>
    </div> -->
</body>
</html>