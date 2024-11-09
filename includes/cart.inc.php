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

if (isset($_GET['action']) && isset($_GET['useridcart']) && isset($_GET['productidcart']) || isset($_GET['qty'])) {
    $action = $_GET['action'];
    $useridcart = $_GET['useridcart'];
    $productidcart = $_GET['productidcart'];
    $qty = $_GET['qty'];

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
       
        update_cart( $pdo, $useridcart, $productidcart, $action, $qty);
        
        
       

        header("Location: ../addToCardPage.php?cartitem=updated");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}



