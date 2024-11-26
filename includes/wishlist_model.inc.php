<?php

declare(strict_types=1);

function get_user_wishlist(object $pdo ,string $user_id){
    $query = "SELECT * FROM wishlist INNER JOIN shoeproduct on wishlist.product_id = shoeproduct.id right join brand on shoeproduct.brand = brand.id right join category on shoeproduct.Category = category.id right join color on shoeproduct.product_color = color.id WHERE userid = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function delete_wishlist(object $pdo ,int $user_id, int $product_id){
    $query = "DELETE FROM wishlist WHERE userid = :user_id and product_id = :product_id ;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":product_id", $product_id);
    

    $stmt->execute();
}

function delete_all_wishlist(object $pdo ,int $user_id){
    $query = "DELETE FROM wishlist WHERE userid = :user_id";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();
}


function wishlist_to_cart(object $pdo, array $product_ids, int $user_id, array $sizes) {
    $query = "INSERT INTO cart (user_id, product_id, size) VALUES (:user_id, :product_id, :size)";
    $stmt = $pdo->prepare($query);

    foreach ($product_ids as $product_id ) {
        // Bind values for each product in the list
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);
         $stmt->bindParam(":size", $sizes[$product_id]);

        // Execute the prepared statement for each product
        $stmt->execute();
    }
}

function get_product_stock(object $pdo, int|array $product_ids, array $sizes) {
    $stockStatuses = [];

    if (is_array($product_ids)) {
        // Handle multiple product IDs with their sizes
        $query = "SELECT * FROM shoe_stocks 
                  INNER JOIN sizes ON shoe_stocks.size_id = sizes.id 
                  WHERE shoe_id = ? AND size = ?";

        $stmt = $pdo->prepare($query);

        foreach ($product_ids as $product_id) {
            // Ensure the size exists for the given product ID
            if (isset($sizes[$product_id])) {
                $stmt->execute([$product_id, $sizes[$product_id]]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Check if the product is available
                $stockStatuses[$product_id] = !empty($result) ? $result : "Unavailable";
            } else {
                // No size provided for this product ID
                $stockStatuses[$product_id] = "Unavailable";
            }
        }
    } else {
        // Handle a single product ID and its size
        $query = "SELECT * FROM shoe_stocks 
                  INNER JOIN sizes ON shoe_stocks.size_id = sizes.id 
                  WHERE shoe_id = ? AND size = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_ids, $sizes[$product_ids] ?? null]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if the product is available
        $stockStatuses[$product_ids] = !empty($result) ? $result : "Unavailable";
    }

    return $stockStatuses;
}


function get_each_product_stock(object $pdo, int|array $product_id, int $size) {
    if (is_array($product_id)) {
        // Handle case when product_id is an array
        $placeholders = implode(',', array_fill(0, count($product_id), '?'));
        $query = "SELECT * FROM shoe_stocks 
                  INNER JOIN sizes ON shoe_stocks.size_id = sizes.id 
                  WHERE shoe_id IN ($placeholders) AND size = ?";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute(array_merge($product_id, [$size]));
    } else {
        // Handle case when product_id is a single integer
        $query = "SELECT * FROM shoe_stocks 
                  INNER JOIN sizes ON shoe_stocks.size_id = sizes.id 
                  WHERE shoe_id = ? AND size = ?";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id, $size]);
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        return "Unavailable";
    }

    return $result;
}


function get_product_cart(object $pdo, int|array $product_id, int $userid){
    if (is_array($product_id)) {
        // Handle case when product_id is an array
        $placeholders = implode(',', array_fill(0, count($product_id), '?'));
        $query = "SELECT * FROM cart 
                  WHERE product_id IN ($placeholders) AND user_id = ?";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute(array_merge($product_id, [$userid]));
    } else {
        // Handle case when product_id is a single integer
        $query = "SELECT * FROM cart 
                  WHERE product_id = ? AND user_id = ?";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$product_id, $userid]);
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        return False;
    }

    return $result;
}
