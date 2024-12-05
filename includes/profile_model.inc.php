<?php

function get_order_history(object $pdo, int $userid){
    
    $query = "SELECT * FROM shoes_order right join shoeproduct on shoes_order.shoes_id = shoeproduct.id RIGHT JOIN order_statuses on shoes_order.order_status = order_statuses.id WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $userid);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}


function cancel_order(object $pdo, int $order_id){
    $query = "UPDATE `shoes_order` SET `order_status`='4' WHERE order_id = :order_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":order_id", $order_id);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}