<?php 

function get_user_topbar(object $pdo ,string $user_id){
    $query = "SELECT * FROM users WHERE id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}



function get_user_address_for_checkout(object $pdo ,string $user_id){
    $query = "SELECT * FROM address WHERE user_id = :user_id AND `default` = 1;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_shoes_detail(object $pdo, int|array $product_id) {
    if (is_array($product_id)) {
        // Handle case when product_id is an array
        $placeholders = implode(',', array_fill(0, count($product_id), '?'));
        $query = "SELECT * FROM shoeproduct right join category ON shoeproduct.Category = category.id
                  WHERE shoeproduct.id IN ($placeholders)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array_values($product_id)); // Ensure array values are used
    } else {
        // Handle case when product_id is a single integer
        $query = "SELECT * FROM shoeproduct right join category ON shoeproduct.Category = category.id
                  WHERE shoeproduct.id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id]);
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (is_array($product_id)) {
        return $result; // Return all rows for an array of product IDs
    } else {
        return $result[0] ?? null; // Return a single row or null for a single product ID
    }
}


function add_orders(object $pdo, int $user_id, array $product_ids, array $sizes, array $quantity,array $total_amout,string $address,string $payment_status) {
    $query = "INSERT INTO shoes_order (user_id, shoes_id, shoe_size, shoe_quantity, total_price, payment_status, buyer_address) VALUES (:user_id, :shoe_id, :shoe_size, :qty , :total_amount,:payment_stats, :b_address)";
    $stmt = $pdo->prepare($query);

    foreach ($product_ids as $product_id ) {
        // Bind values for each product in the list
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":shoe_id", $product_id);
        $stmt->bindParam(":shoe_size", $sizes[$product_id]);
        $stmt->bindParam(":qty", $quantity[$product_id]);
        $stmt->bindParam(":total_amount", $total_amout[$product_id]);
        $stmt->bindParam(":payment_stats", $payment_status);
        $stmt->bindParam(":b_address", $address);
        
      


        // Execute the prepared statement for each product
        $stmt->execute();
    }
}

function add_to_online_transaction($pdo, $userid, $product_id, $transaction_id, $transaction_status, $total){
    $stmt = $pdo->prepare("
        INSERT INTO online_transaction (customer_id, shoe_id, transaction_status, transaction_id, total_amount)
        VALUES (:user_id,:product_id, :transacstat, :transaction_id, :total_amount)
    ");
    $stmt->execute([
        ':user_id' => $userid,
        ':product_id' => $product_id,
        ':transacstat' => $transaction_status,
        ':transaction_id' => $transaction_id,
        ':total_amount' => $total,


    ]);
}

function add_order($pdo, $userid, $product_id, $size, $qty, $total, $address, $payment_status) {
    $stmt = $pdo->prepare("
        INSERT INTO shoes_order (user_id, shoes_id, shoe_size, shoe_quantity, total_price, payment_status, buyer_address)
        VALUES (:user_id, :product_id, :size, :quantity, :total_amount, :payment_status, :baddress)
    ");
    $stmt->execute([
        ':user_id' => $userid,
        ':product_id' => $product_id,
        ':size' => $size,
        ':quantity' => $qty,
        ':total_amount' => $total,
        ':payment_status' => $payment_status,
        ':baddress' => $address

    ]);
}

function remove_order_from_cart($pdo, $userid, $product_id, $size, $qty) {
    $stmt = $pdo->prepare("
        DELETE FROM cart
        WHERE user_id = :user_id AND product_id = :product_id AND size = :size AND quantity_cart = :quantity
    ");
    $stmt->execute([
        ':user_id' => $userid,
        ':product_id' => $product_id,
        ':size' => $size,
        ':quantity' => $qty,
    ]);
}

function remove_orders_from_cart(object $pdo, int $user_id, array $product_ids, array $sizes, array $quantity ){
    $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id AND quantity_cart = :quantity AND `size` = :shoe_size";
    $stmt = $pdo->prepare($query);

    foreach ($product_ids as $product_id ) {
        // Bind values for each product in the list
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":shoe_size", $sizes[$product_id]);
        $stmt->bindParam(":quantity", $quantity[$product_id]);
  
        
      


        // Execute the prepared statement for each product
        $stmt->execute();
    }
}