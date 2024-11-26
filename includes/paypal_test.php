<?php
include 'paypal_config.php';
include 'paypal.inc.php';

$paypal = new PayPal(PAYPAL_CLIENT_ID, PAYPAL_SECRET_ID);

$payment = $paypal->createPayment(200);
print_r($payment)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Paypal</title>
</head>
<body>
    <table>
        <tr><th>Name</th><td> Software</td></tr>
        <tr><th>Price</th><td> 2000</td></tr>
        <tr><th></th><td> <a href=""> Pay with paypal</a> </td></tr>
    </table>
</body>
</html>