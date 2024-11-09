<?php

declare(strict_types=1);

function get_user_cart(object $pdo ,string $user_id){
    $query = "SELECT * FROM cart INNER JOIN shoeproduct on cart.product_id = shoeproduct.id right join brand on shoeproduct.brand = brand.id right join category on shoeproduct.Category = category.id right join color on shoeproduct.product_color = color.id WHERE user_id = :user_id;";

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

function update_cart(object $pdo ,int $user_id, int $product_id, string $action, ?int $qty = null){
    
    if ($action == 'increase') {
        // Code to increase the quantity
        $query = "UPDATE cart SET quantity_cart = quantity_cart + 1 WHERE user_id = :user_id AND product_id = :product_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);


        $stmt->execute();
    } else if ($action == 'decrease') {

        // Code to decrease the quantity
        $query = "UPDATE cart SET quantity_cart = quantity_cart  - 1 WHERE user_id = :user_id AND product_id = :product_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);


        $stmt->execute();

    }else if ($action == 'updatecartqty' && !is_null($qty)) {
        // Code to decrease the quantity
        $query = "UPDATE cart SET quantity_cart = :qty WHERE user_id = :user_id AND product_id = :product_id";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":product_id", $product_id);
        $stmt->bindParam(":qty", $qty);

        $stmt->execute();

    }
    
    

}
