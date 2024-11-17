<?php

 declare(strict_types=1);



 function is_input_empty(string $username,  string $pwd,  string $email, string $num){
    if (empty($username) || empty($pwd) || empty($email) || empty($num)) {
        return true;
    }else{
        return false;
    }
 }

 function pwd_is_not_same(string $pwd, string $cpwd){
    if ($pwd !== $cpwd) {
        return true;
    }else{
        return false;
    }
 }

 function is_valid_email( string $email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else{
        return false;
    }
 }

 
 function is_username_taken(object $pdo, string $username){
    if (get_username( $pdo, $username)) {
        return true;
    }else{
        return false;
    }
 }

 function is_email_taken(object $pdo, string $email){
    if (get_email( $pdo, $email)) {
        return true;
    }else{
        return false;
    }
 }

 function num_valid( string $num){
    if (strlen($num) !== 11) {
        return true;
    }else{
        return false;
    }
 }

 function create_user(object $pdo, string $firstname, string $lastname, string $pwd, string $email, string $num){
   set_user( $pdo,  $firstname, $lastname,  $pwd,  $email, $num);

 }


