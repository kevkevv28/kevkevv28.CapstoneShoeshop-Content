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

function get_stocks(object $pdo,int $product_id){
    $query = "SELECT SUM(shoes_stock) as allstocks FROM shoe_stocks where shoe_id = :product_id ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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

 function make_all_address_default_to_zero(object $pdo, int $user_id){
    $query = "UPDATE address SET `default` = '0' where user_id = :user_id;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);

    
    $stmt->execute();
 }

 function save_address(object $pdo, int $usersid,string $address,string $streetandbrgy,string $city,int $postal,int $phone,int $default){
    // Check if $default is 1; if not, set it to 0
    $default = ($default === 1) ? 1 : 0;
    
    $query = "INSERT INTO address (`user_id`, `address`, `brgy_street`, `city`, `zipcode`, `mobile_no`, `default`) VALUES (:user_id, :address, :brgy_street, :city, :zipcode, :mobile_no, :default );";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $usersid);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":brgy_street", $streetandbrgy);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":zipcode", $postal);
    $stmt->bindParam(":mobile_no", $phone);
    $stmt->bindParam(":default", $default);
    
    $stmt->execute();
 }

 function edit_address(object $pdo,int $id, int $usersid,string $address,string $streetandbrgy,string $city,int $postal,int $phone,int $default = null){
    // Check if $default is 1; if not, set it to 0
    $default = ($default === 1) ? 1 : 0;
    
    $query = "UPDATE address SET `address` = :addresses , brgy_street = :brgy_street, city = :city , zipcode = :zipcode , mobile_no = :mobile_no , `default` = :defaults WHERE id = :id AND user_id = :userid";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":userid", $usersid);
    $stmt->bindParam(":addresses", $address);
    $stmt->bindParam(":brgy_street", $streetandbrgy);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":zipcode", $postal);
    $stmt->bindParam(":mobile_no", $phone);
    $stmt->bindParam(":defaults", $default);
    
    $stmt->execute();
 }

 function delete_address(object $pdo, int $user_id,int $address_id){
    $query = "DELETE FROM address WHERE user_id = :user_id AND id = :id";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":id", $address_id);

    $stmt->execute();
 }

 function get_user_addresses(object $pdo, int $user_id){
    $query = "SELECT * FROM address WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_id", $user_id);
    
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
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

function get_product_stock(object $pdo, int|array $product_id, int $size) {
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