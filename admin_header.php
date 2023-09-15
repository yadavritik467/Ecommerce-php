<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"></a>
            <nav class="navbar">
                <a href="admin_pannel.php">Home</a>
                <a href="admin_product.php">Products</a>
                <a href="admin_order.php">Orders</a>
                <a href="admin_user.php">Users</a>
                <a href="admin_message.php">Message</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
                <!--put icons here -->
                <!--put icons here -->
            </div>
            <div class="user-box">
                <p>Username : <span>
                    <?php echo $_SESSION['admin_name']?>
                </span></p>
                <p>Email : <span>
                    <?php echo $_SESSION['admin_email']?>
                </span></p>
                <form action="" method="post">
                <button type="submit" name="logout" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>Admin dashboard</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis esse!</p>
        </div>
    </div>
</body>
</html>