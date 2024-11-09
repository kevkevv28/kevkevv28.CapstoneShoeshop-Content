<?php

declare(strict_types=1);



function get_product(object $pdo, $id = null, string $option = null) {
    // Check if an ID is provided
    if($option == "brand"){
        if ($id) {
            // If an ID is provided, fetch only the product with that ID
            $query = "SELECT * FROM shoeproduct WHERE brand = :id ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the ID parameter
        } else {
            // If no ID is provided, fetch all products
            $query = "SELECT * FROM shoeproduct ORDER BY `shoeproduct`.`id` ASC";
            $stmt = $pdo->prepare($query);
        }

    }else if ($option == "color"){
        if ($id) {
            // If an ID is provided, fetch only the product with that ID
            $query = "SELECT * FROM shoeproduct WHERE product_color = :id ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the ID parameter
        } else {
            // If no ID is provided, fetch all products
            $query = "SELECT * FROM shoeproduct ORDER BY `shoeproduct`.`id` ASC";
            $stmt = $pdo->prepare($query);
        }
    }else if ($option == "category"){
        if ($id) {
            // If an ID is provided, fetch only the product with that ID
            $query = "SELECT * FROM shoeproduct WHERE category = :id ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the ID parameter
        } else {
            // If no ID is provided, fetch all products
            $query = "SELECT * FROM shoeproduct ORDER BY `shoeproduct`.`id` ASC";
            $stmt = $pdo->prepare($query);
        }
    }else{
        $query = "SELECT * FROM shoeproduct ORDER BY shoeproduct.id ASC";
        $stmt = $pdo->prepare($query);
    }
    

    // Execute the query
    $stmt->execute();

    // Fetch and return the result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function get_brand(object $pdo){
    $query = "SELECT * FROM brand ";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_color(object $pdo){
    $query = "SELECT * FROM color ";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_category(object $pdo){
    $query = "SELECT * FROM category ";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function get_single_product(object $pdo, int $id){
    $query = "SELECT * FROM shoeproduct INNER JOIN brand on shoeproduct.brand = brand.id INNER JOIN color on shoeproduct.product_color = color.id where shoeproduct.id = :id ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    return $result;
}


function get_size(object $pdo){
    $query = "SELECT * FROM sizes ";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_user_wish(object $pdo ,string $user_id){
    $query = "SELECT * FROM users WHERE id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_wishlist(object $pdo, int $product_id,  int $user_id, int $size){
    $query = "INSERT INTO wishlist (product_id, userid, size) VALUES (:product_id, :user_id, :size);";

    $stmt = $pdo->prepare($query);

    
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":size", $size);
    
    $stmt->execute();
 }

function get_wishlist_specific(object $pdo, int $product_id, int $user_id){
    
    $query = "SELECT * FROM wishlist WHERE product_id = :product_id AND userid = :user_id;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":user_id", $user_id);
    
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function add_to_cart(object $pdo, int $product_id, int $user_id, int $size, int $qty) {
    $query = "INSERT INTO cart (user_id, product_id, quantity_cart, size) VALUES (:user_id, :product_id, :quantity_cart, :size_id)";
    $stmt = $pdo->prepare($query);

    
    // Bind values for each product in the list
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":product_id", $product_id);
    $stmt->bindParam(":quantity_cart", $qty);
    $stmt->bindParam(":size_id", $size);

    // Execute the prepared statement for each product
    $stmt->execute();

}