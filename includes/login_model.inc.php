<?php

declare(strict_types=1);

function get_user(object $pdo ,string $email){
    $query = "SELECT * FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_user_topbar(object $pdo ,string $user_id){
    $query = "SELECT * FROM users WHERE id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_user_address(object $pdo ,string $user_id){
    $query = "SELECT * FROM address WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_user_address_for_checkout(object $pdo ,string $user_id){
    $query = "SELECT * FROM address WHERE user_id = :user_id AND default = 1;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_wishlist_count(object $pdo ,string $user_id){
    $query = "SELECT count(*) as wishcount FROM wishlist WHERE userid = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_cart_count(object $pdo ,string $user_id){
    $query = "SELECT count(*) as cartcount FROM cart WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_address_count(object $pdo ,int $user_id){
    $query = "SELECT count(*) as addresscount FROM address WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


