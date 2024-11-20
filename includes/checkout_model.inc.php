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
