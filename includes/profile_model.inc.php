<?php

function get_order_history(object $pdo, int $userid){
    
    $query = "SELECT * FROM shoes_order right join shoeproduct on shoes_order.shoes_id = shoeproduct.id WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $userid);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}