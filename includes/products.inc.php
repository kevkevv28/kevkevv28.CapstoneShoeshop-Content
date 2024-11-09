<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addtocart'])) {
    
    $productid = $_POST["product_id"];
    $usersid = $_POST["user_id"];
    $size = $_POST['size'];
    $qty = $_POST['product-quantity'];

   
    try {
        require_once 'dbh.inc.php';
        require_once 'products_model.inc.php';
        require_once 'products_contrl.inc.php';
        include_once 'config_session.inc.php';
     
        $errors = [];

        if (empty($size)) {
            $errors['sizeNotSelected'] = "Product Size not Selected ";
        } 

        

        if ($errors) {
            $_SESSION["errors_product"] = $errors;

          
           
            header("Location: ../product_single.php?prodid=". $productid. "");
            die();
        }
     
        
       add_to_cart( $pdo,  $productid, $usersid, $size, $qty);
        $success = [];
        
        $success['added_cart'] = "Product Added to cart";

        $_SESSION["added"] = $success;

        header("Location: ../addToCardPage.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

   
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addwishlist'])) {
    
    $productid = $_POST["product_id"];
    $usersid = $_POST["user_id"];
    $size = $_POST['size'];

  
        
    try {
        require_once 'dbh.inc.php';
        require_once 'products_model.inc.php';
        require_once 'products_contrl.inc.php';
        include_once 'config_session.inc.php';
        //ERROR HANDLERS    
        if(is_already_in($pdo, $productid, $usersid)){
            $errors['already_have'] = "Product Already in Wishlist!";
        }
        
        if (empty($size)) {
            $errors['sizeNotSelected'] = "Product Size not Selected ";
        } 
        
        if ($errors) {
            $_SESSION["errors_wishlist"] = $errors;

          
           
            header("Location: ../product_single.php?prodid=$productid&wishlist=already");
            die();
        }
        /*
        $errors = [];

        if (!isset($product_size)) {
            $errors['sizeNotSelected'] = "Please Select Size";
        } 

        

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

          
           
            header("Location: ../product_single.php");
            die();
        }
       */
        
        create_wishlist( $pdo, $productid, $usersid, $size);
        $success = [];
        
        $success['wishlist_added'] = "success";

        unset($_SESSION["errors_product"]);
        $_SESSION["wishlist"] = $success;

        header("Location: ../product_single.php?prodid=$productid&wishlist=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}

