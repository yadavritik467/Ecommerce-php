
    
     <?php
include 'connection.php';
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();



// new one 


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


use Razorpay\Api\Api;

$api = new Api($keyId,$keySecret);


// order through online

if(isset($_POST['order_btn_online'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
   $total_amount = $_POST['total_amount'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $pincode = $_POST['pincode'];
    $placed_on = date('D-M-Y');


    // $_SESSION['razorpay_payment_id'] = $_POST['razorpay_payment_id'];
    // $_SESSION['razorpay_signature'] = $_POST['razorpay_signature'];

    // $cart_total = 0;
    // $cart_product = [];





    // put order data here

    $orderData = [
        'receipt'         => '3456',
        'amount'          => $total_amount * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
    ];
    
    $razorpayOrder = @$api->order->create($orderData);
    
    $razorpayOrderId = $razorpayOrder['id'];
    
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    
    $displayAmount = $amount = $orderData['amount'];
    
    if ($displayCurrency !== 'INR')
    {
        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
        $exchange = json_decode(file_get_contents($url), true);
    
        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }
    
    $checkout = 'automatic';
    
    if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
    {
        $checkout = $_GET['checkout'];
    }
    
    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "DJ T",
        "description"       => "Tron Legacy",
        "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
        "prefill"           => [
        "name"              => "Daft Punk",
        "email"             => $name,
        "contact"           => $number,
        ],
        "notes"             => [
        "address"           => $street,
        "merchant_order_id" => "12312321",
        ],
        "theme"             => [
        "color"             => "#F37254"
        ],
        "order_id"          => $razorpayOrderId,
    ];
    
    if ($displayCurrency !== 'INR')
    {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }
    
    $json = json_encode($data);

    // // echo $json;

    require("checkout/manual.php");


    $cart_query = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($cart_query)>0){
        while ($cart_item=mysqli_fetch_assoc($cart_query)){
            $cart_product[] = $cart_item['name'].'('.$cart_item['quantity'].')';

        }
    }
    $total_products = implode(',',$cart_product);

    mysqli_query($conn, "INSERT INTO `order`(`user_id`,`name`,`email`,`number`,`method`,`flat`,`street`,`city`,`country`,`pincode`,`total_products`,`total_price`,`placed_on`,`payment_status`) VALUES('$user_id','$name','$email','$number','online','$flat','$street','$city','$country','$pincode','$total_products','$total_amount','$placed_on','false')") or die("query failed");


    


   
}

// new one 




// Create the Razorpay Order


//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//


$message[] = 'order placed successfully';
// header('location:checkout_online.php');


?>
   



