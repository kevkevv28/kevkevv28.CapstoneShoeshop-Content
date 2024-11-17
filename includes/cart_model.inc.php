<?php

declare(strict_types=1);

function get_user_cart(object $pdo ,string $user_id){
    $query = "SELECT *,sizes.id as size_id FROM cart INNER JOIN shoeproduct on cart.product_id = shoeproduct.id right join brand on shoeproduct.brand = brand.id right join category on shoeproduct.Category = category.id right join color on shoeproduct.product_color = color.id right join sizes on cart.size = sizes.size WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function delete_cart(object $pdo ,int $user_id, int $product_id){
    $query = "DELETE FROM cart WHERE user_id = :user_id and product_id = :product_id ;";

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


function wishlist_to_cart(object $pdo, array $product_ids, int $user_id) {
    $query = "INSERT INTO cart (user_id, product_id) VALUES (:user_id, :product_id)";
    $stmt = $pdo->prepare($query);

    foreach ($product_ids as $product_id) {
        // Bind values for each product in the list
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);

        // Execute the prepared statement for each product
        $stmt->execute();
    }
}

function delete_all_cart(object $pdo ,int $user_id){
    $query = "DELETE FROM cart WHERE user_id = :user_id";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();
}

function update_cart(object $pdo, int $user_id, int $product_id, string $action, ?int $qty = null, ?int $size = null) {
    // Fetch current quantity and stock information
    $get_quantity = get_specific_quantiity($pdo, $user_id, $product_id);
    $get_stock = get_stock_for_shoes($pdo, $product_id, $size);

    // Initialize errors array
    $errors = [];

    // Stock validation logic
    if ($action === 'increase') {
        // Check if the new quantity exceeds available stock
        if (($get_quantity['quantity_cart'] + 1) > $get_stock['shoes_stock']) {
            $errors['Quantity_error_above_stock'] = "Cannot increase quantity. Stock not available.";
        }
    } elseif ($action === 'decrease') {
        // Check if the new quantity falls below 1
        if (($get_quantity['quantity_cart'] - 1) < 1) {
            $errors['Quantity_error'] = "Cannot reduce quantity below 1.";
        }
    } elseif ($action === 'updatecartqty' && !is_null($qty)) {
        // Validate the updated quantity against stock limits
        if ($qty < 1) {
            $errors['Quantity_error'] = "Please don't set quantity below 1.";
        }
        if ($qty > $get_stock['shoes_stock']) {
            $errors['Quantity_error_above_stock'] = "Stock not available.";
        }
    }

    // If there are errors, set session errors and stop execution
    if ($errors) {
        $_SESSION["cart_error"] = $errors;
        header("Location: ../addToCardPage.php");
        die();
    }

    // Perform the appropriate update
    if ($action === 'increase') {
        $query = "UPDATE cart SET quantity_cart = quantity_cart + 1 WHERE user_id = :user_id AND product_id = :product_id";
    } elseif ($action === 'decrease') {
        $query = "UPDATE cart SET quantity_cart = quantity_cart - 1 WHERE user_id = :user_id AND product_id = :product_id";
    } elseif ($action === 'updatecartqty' && !is_null($qty)) {
        $query = "UPDATE cart SET quantity_cart = :qty WHERE user_id = :user_id AND product_id = :product_id";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":product_id", $product_id);
    if ($action === 'updatecartqty' && !is_null($qty)) {
        $stmt->bindParam(":qty", $qty);
    }
    $stmt->execute();
}


function get_specific_quantiity(object $pdo ,int $user_id,int $product_id){
    $query = "SELECT * from cart WHERE user_id = :user_id and product_id = :productid ;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":productid", $product_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_stock_for_shoes(object $pdo ,int $product_id, int $size){
    $query = "SELECT * from shoe_stocks right join sizes  on shoe_stocks.size_id = sizes.id WHERE size = :size and shoe_id = :productid ;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":size", $size);
    $stmt->bindParam(":productid", $product_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}