<?php
// Include necessary files to connect to the database
require_once 'dbh.inc.php';

// Ensure the request contains both product_id and size_id
if (isset($_POST['product_id']) && isset($_POST['size_id'])) {
    // Get product_id and size_id from POST request
    $product_id = $_POST['product_id'];
    $size_id = $_POST['size_id'];

    // Query to get the stock for the selected product and size
    $sql = "SELECT shoes_stock FROM shoe_stocks WHERE shoe_id = :product_id AND size_id = :size_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id, 'size_id' => $size_id]);

    // Fetch the stock count
    $stock = $stmt->fetchColumn();

    // Return the stock count as JSON response
    echo json_encode(['stock' => $stock]);
} else {
    // Handle error if product_id or size_id is missing
    echo json_encode(['error' => 'Invalid request. Product or size not specified.']);
}
?>
