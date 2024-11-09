<?php

declare(strict_types=1);

function get_user(object $pdo ,string $username){
    $query = "SELECT * FROM users WHERE username = :username;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
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

