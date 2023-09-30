<?php

include 'connection.php';
require('config.php');

session_start();

$user_id = $_SESSION['user_id'];



if (!isset($user_id)) {
    echo '<script>
    window.location.href = "login.php";
    </script>';
    exit();
}

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );
            // echo $_SESSION['razorpay_order_id'];
            //         echo $_POST['razorpay_payment_id'];
            //     echo   $_POST['razorpay_signature'] ;
        $api->utility->verifyPaymentSignature($attributes);

        $razorpay_payment_id = mysqli_real_escape_string($conn, $_POST['razorpay_payment_id']);

        // Update the payment_id in the 'order' table
        mysqli_query($conn, "UPDATE `order` SET payment_id = '$razorpay_payment_id' , payment_status = 'complete' WHERE user_id='$user_id'") or die('query failed');

        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die("query failed");
    
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}



if ($success === true)
{
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>
             <a href='order.php'>Go TO YOUR ORDER LIST</a>";
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
