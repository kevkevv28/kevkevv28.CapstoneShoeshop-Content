<?php

 declare(strict_types=1);

 function get_username(object $pdo, string $username){
    $query = "SELECT username FROM users WHERE username = :username;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
 }

 function get_email(object $pdo, string $email){
    $query = "SELECT email FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":email", $email);
    
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
 }

 function set_user(object $pdo, string $firstname, string $lastname, string $pwd, string $email, string $num){
    $query = "INSERT INTO users (first_name, last_name, pwd, email, contact_num) VALUES (:first_name,:last_name, :pwd, :email, :num);";

    $stmt = $pdo->prepare($query);

    $options = [
        'costs' => 12
    ];

    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    
    $stmt->bindParam(":first_name", $firstname);
    $stmt->bindParam(":last_name", $lastname);
    $stmt->bindParam(":pwd", $hashedpwd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":num", $num);

    $stmt->execute();
 }