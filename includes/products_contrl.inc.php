<?php

declare(strict_types=1);

function is_product_empty(string $product_name,  string $product_color,  string $product_brand, string $product_category, string $product_qty, string  $product_price, string $product_description){
    if (empty($product_name) || empty($product_color) || empty($product_brand) || empty($product_category) || empty($product_qty) || empty($product_price) || empty($product_description)) {
        return true;
    }else{
        return false;
    }
 }

 function create_product(object $pdo, string $product_name,  string $product_color,  string $product_brand, string $product_category, string $product_qty, string  $product_price, string $product_description,string $filename){
    set_product( $pdo,  $product_name, $product_color,  $product_brand, $product_category, $product_qty,  $product_price, $product_description, $filename);
 
  }

  function Ext_allowed(string $fileActualExt, array $allowed){
    if(!in_array( $fileActualExt,$allowed )){
        return true;
    }else{
        return false;
    }
  }


  function update_product(object $pdo, string $product_name,  string $product_color,  string $product_brand, string $product_category, string $product_qty, string  $product_price, string $product_description,string $filename, int $product_id){
    update_prod( $pdo,  $product_name, $product_color,  $product_brand, $product_category, $product_qty,  $product_price, $product_description, $filename, $product_id);
 
  }

  function delete_product(object $pdo, int $product_id){
    delete_prod( $pdo, $product_id);
 
  }

  function create_wishlist(object $pdo, int $product_id,  int $user_id, int $size){
    set_wishlist( $pdo,  $product_id, $user_id, $size);
 
  }

  function is_already_in(object $pdo, int $product_id, int $user_id){
    if (get_wishlist_specific( $pdo, $product_id, $user_id)) {
        return true;
    }else{
        return false;
    }
 }