<?php
include 'connection.php';
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}



// using razorpay 
// require('razorpay-php/Razorpay.php');

// use Razorpay\Api\Api;

// $api = new Api($keyId,$keySecret);


// order through online

// if(isset($_POST['order_btn_online'])){
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $number = $_POST['number'];
// //    $total_amount = $_POST['total_amount'];
//     $flat = $_POST['flat'];
//     $street = $_POST['street'];
//     $city = $_POST['city'];
//     $country = $_POST['country'];
//     $pincode = $_POST['pincode'];
//     $placed_on = date('D-M-Y');


//     $_SESSION['razorpay_payment_id'] = $_POST['razorpay_payment_id'];
//     $_SESSION['razorpay_signature'] = $_POST['razorpay_signature'];

//     $cart_total = 0;
//     $cart_product[] = '';

    


//     $cart_query = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

//     if(mysqli_num_rows($cart_query)>0){
//         while ($cart_item=mysqli_fetch_assoc($cart_query)){
//             $cart_product[] = $cart_item['name'].'('.$cart_item['quantity'].')';
//             $sub_total= ($cart_item['price']*$cart_item['quantity']);
//             $cart_total += $sub_total;


//             $orderData = [
//                 'receipt'         => '3456', // Your unique order ID or receipt number
//                 'amount'          => $cart_total * 100, // Amount in paise (smallest unit of currency)
//                 'currency'        => 'INR', // Indian Rupees
//                 'payment_capture' => 1 // Auto-capture payment after order creation
//             ];
        
//             $razorpayOrder = $api->order->create($orderData);
//             $razorpayOrderId = $razorpayOrder['id'];
//             $_SESSION['razorpay_order_id'] = $razorpayOrderId;
//             $displayAmount = $amount = $orderData['amount'];

//                      if ($displayCurrency !== 'INR')
//           {
//     $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
//     $exchange = json_decode(file_get_contents($url), true);

//     $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
//           }

// $checkout = 'automatic';

// if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
// {
//     $checkout = $_GET['checkout'];
// }

// $data = [
//     "key"               => $keyId,
//     "amount"            => $amount,
//     "name"              => $name,
//     "description"       => "Tron Legacy",
//     "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
//     "prefill"           => [
//     "name"              => "Daft Punk",
//     "email"             => "customer@merchant.com",
//     "contact"           => "9999999999",
//     ],
//     "notes"             => [
//     "address"           => $street,
//     "merchant_order_id" => "12312321",
//     ],
//     "theme"             => [
//     "color"             => "#F37254"
//     ],
//     "order_id"          => $razorpayOrderId,
// ];

// if ($displayCurrency !== 'INR')
// {
//     $data['display_currency']  = $displayCurrency;
//     $data['display_amount']    = $displayAmount;
// }

// $json = json_encode($data);

// require("checkout/manual.php");

//         }
//     }
//     $total_products = implode(',',$cart_product);

//     mysqli_query($conn, "INSERT INTO `order`(`user_id`,`name`,`email`,`number`,`method`,`flat`,`street`,`city`,`country`,`pincode`,`total_products`,`total_price`,`placed_on`,`payment_status`) VALUES('$user_id','$name','$email','$number','online','$flat','$street','$city','$country','$pincode','$total_products','$cart_total','$placed_on','complete')") or die("query failed");


//     mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die("query failed");


//     $message[] = 'order placed successfully';
//     header('location:checkout.php');
// }

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
    <style>
    <?php include 'style.css';
    ?>
    </style>

<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

</head>


<body>

    <?php  include 'header.php'; ?>


    <div class="banner">
        <div class="detail">
            <h1>Order</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur quo odit mollitia minus blanditiis
                esse!</p>
            <a href="index.php">Home </a> /<span>order</span>
        </div>
    </div>
    <div class="line2"></div>

    <div class="checkout-form">
        <h1 class="title">Payment process</h1>
        <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="message">
                <span>'.$message.'</span>
                <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>
                ';
            }
        }
        ?>

        <div class="display-order">
            <div class="box-container">


                <?php 
            $select_cart = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id' ")
            or die('query failed');
            $total = 0;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart)>0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                    $grand_total = $total += $total_price; 
               
            ?>


                <div class="box">
                    <img src="image/<?php echo $fetch_cart['image'];?>">
                    <!-- <span><?= $fetch_cart['name'];?> (<?= $fetch_cart['quantity']?>) </span> -->
                    <span>Name: <?php echo $fetch_cart['name'];?></span>
                    <span>Quantity: <?php echo $fetch_cart['quantity'];?></span>
                </div>

                <?php 
             }
            }
            ?>
            </div>
            <span class="grand-total">Total Amount Payable : $<?= $grand_total; ?></span>
        </div>
        <form  id="checkout-selection" action="pay.php" method="post">
            <!-- <div class="input-field"> -->
                <!-- <label>Total Amount</label> -->
                <input type="hidden" name="total_amount" value=" <?php echo $grand_total; ?>" >
            <!-- </div> -->
            <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="name" placeholder="Enter your name">
            </div>

            <div class="input-field">
                <label>Your Number</label>
                <input type="text" name="number" placeholder="Enter your number">
            </div>
            <div class="input-field">
                <label>Your Email</label>
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            <div class="input-field">
                <label>Flat no. </label>
                <input type="text" name="flat" placeholder="e.g. flat no.">
            </div>
            <div class="input-field">
                <label>Street no. </label>
                <input type="text" name="street" placeholder="e.g. street name">
            </div>
            <div class="input-field">
                <label>City</label>
                <input type="text" name="city" placeholder="e.g. delhi">
            </div>
            <div class="input-field">
                <label>state</label>
                <input type="text" name="state" placeholder="e.g. new delhi">
            </div>
            <div class="input-field">
                <label>country</label>
                <input type="text" name="country" placeholder="e.g. India">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="text" name="pincode" placeholder="e.g. 496001">
            </div>
            <div class="input-field"> 
            <!-- <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id"> -->
            </div>
            <div class="input-field">
                <!-- <input type="hidden" name="razorpay_signature"  id="razorpay_signature" id="razorpay_signature"> -->
            </div>
           
            <input  id="rzp-button1" type="submit" name="order_btn_online" class="btn order_btn_online" value="order with online">
        </form>




    </div>


    <div class="line2"></div>

    <?php  include 'footer.php'; ?>


    <script src="script.js"></script>
    <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

    


<script>
// var options = <?php echo $json?>;

// var rzp = new Razorpay(options);
// document.getElementById('rzp-button1').onclick = async function(e){
//     await rzp.open();
//     e.preventDefault();
//     console.log('click')

//     options.handler = async function (response){
//    await document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
//    await document.getElementById('razorpay_signature').value = response.razorpay_signature;
//    await document.razorpayform.submit();
// };
// options.theme.image_padding = false;
// options.modal = {
//     ondismiss: function() {
//         console.log("This code runs when the popup is closed");
//     },
//     escape: true,
//     backdropclose: false
// };
// }
</script>
 
   
</body>

</html>