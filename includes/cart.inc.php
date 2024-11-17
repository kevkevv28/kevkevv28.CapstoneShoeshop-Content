<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['delall'])) {
    $userid = $_POST["userid"];

    try {
        require_once 'dbh.inc.php';
        require_once 'cart_model.inc.php';
        require_once 'cart_contrl.inc.php';
        include_once 'config_session.inc.php';
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
        
        delete_all_cart( $pdo, $userid);
        $success = [];
        
        $success['wishlist_deleted'] = "Products Deleted";

        $_SESSION["cart"] = $success;

        header("Location: ../addToCardPage.php?cart=deleted");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }
   

}

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['delcartbtn'])) {
    $userid = $_POST["userid"];
    $productid = $_POST["productid"];

    try {
        require_once 'dbh.inc.php';
        require_once 'cart_model.inc.php';
        require_once 'cart_contrl.inc.php';
        include_once 'config_session.inc.php';
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
        
        delete_cart( $pdo, $userid, $productid);
        $success = [];
        
        $success['wishlist_deleted'] = "Wishlist Deleted";

        $_SESSION["wishlist"] = $success;

        header("Location: ../addToCardPage.php?cartitem=deleted");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}

if (isset($_GET['action']) && isset($_GET['useridcart']) && isset($_GET['productidcart']) && isset($_GET['size']) || isset($_GET['qty'])) {
    $action = $_GET['action'];
    $useridcart = $_GET['useridcart'];
    $productidcart = $_GET['productidcart'];
    $size = $_GET['size'];
    $qty = $_GET['qty'];

    try {
        require_once 'dbh.inc.php';
        require_once 'cart_model.inc.php';
        require_once 'cart_contrl.inc.php';
        include_once 'config_session.inc.php';
        
        $get_quantity = get_specific_quantiity($pdo, $useridcart, $productidcart);
        $get_stock = get_stock_for_shoes($pdo, $productidcart, $size);
        /*echo $get_quantity['quantity_cart'];
        echo $get_stock['shoes_stock'];
        */
        /*
        $errors = [];
        
        if ($get_quantity['quantity_cart'] < 1) {
            $errors['Quantity_error'] = "Please Don't reduce quantity below 1";
        } 

        if ($get_quantity['quantity_cart'] > ($get_stock['shoes_stock'] - 1)){
            $errors['Quantity_error_above_stock'] = " Stocks not available";

        }
        

        if ($errors) {
            $_SESSION["cart_error"] = $errors;

          
           
            header("Location: ../addToCardPage.php");
            die();
        }

        
        */
        update_cart( $pdo, $useridcart, $productidcart, $action, $qty, $size);
        
        
       

        header("Location: ../addToCardPage.php?cartitem=updated");

        $pdo = null;
        $stmt = null;

        die();
        
    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}



