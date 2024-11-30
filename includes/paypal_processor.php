<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $transaction_id = $_POST['transaction_id'] ?? null;
    $transaction_status = $_POST['transaction_status'] ?? null;
    $userid = $_POST["user"] ?? null;
    $address = $_POST['addres'] ?? null; 
    $product_ids = $_POST['product_id'] ?? null;
    $sizes = $_POST['sizes'] ?? null;
    $quantity = $_POST['qtys'] ?? null;
    $total_amount = $_POST['total_shoe'] ?? null;
    $payment_status = 'Paypal';

    if (!$transaction_id || !$transaction_status || !$userid || !$product_ids || !$total_amount) {
        http_response_code(400); // Bad Request
        echo "Required fields are missing.";
        exit;
    }

    try {
        // Include database and model files
        require_once 'dbh.inc.php';
        require_once 'checkout_model.inc.php';
        include_once 'config_session.inc.php';

        // Loop through each product and process the order
        foreach ($product_ids as $index => $product_id) {
            $size = $sizes[$index] ?? null;
            $qty = $quantity[$index] ?? null;
            $total = $total_amount[$index] ?? null;

            if ($size && $qty && $total) {
                add_to_online_transaction($pdo, $userid,$product_id, $transaction_id, $transaction_status, $total );
                add_order($pdo, $userid, $product_id, $size, $qty, $total, $address, $payment_status);
                remove_order_from_cart($pdo, $userid, $product_id, $size, $qty);

            }
        }

        // Success message
        $success = [];
        $success['Order_success'] = "Online Payment Successful. Thank you for your purchase!";
        $_SESSION["checkout_success"] = $success;
        echo 1;
        $pdo = null;
        exit;

    } catch (PDOException $e) {
        // Handle any database errors
        die("Database Error: " . $e->getMessage());
    }

} else {
    // Redirect to the checkout page if accessed incorrectly
    header("Location: ../checkout.php");
    exit;
}

http_response_code(405); // Method Not Allowed
echo "Invalid request method.";
exit;
