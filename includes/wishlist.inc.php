<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['delwishbtn'])) {
    $userid = $_POST["userid"];
    $productid = $_POST["productid"];

    try {
        require_once 'dbh.inc.php';
        require_once 'wishlist_model.inc.php';
        require_once 'wishlist_contrl.inc.php';
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
        
        delete_wishlist( $pdo, $userid, $productid);
        $success = [];
        
        $success['wishlist_deleted'] = "Wishlist Deleted";

        $_SESSION["wishlist"] = $success;

        header("Location: ../wishlist.php?wishlist=deleted");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['delall'])) {
    $userid = $_POST["userid"];

    try {
        require_once 'dbh.inc.php';
        require_once 'wishlist_model.inc.php';
        require_once 'wishlist_contrl.inc.php';
        include_once 'config_session.inc.php';
        
        $errors = [];

        if (empty($userid)) {
            $errors['empty'] = "No item to be deleted";
        } 

        

        if ($errors) {
            $_SESSION["alreadydel"] = $errors;

          
           
            header("Location: ../wishlist.php");
            die();
        }
       
        
        delete_all_wishlist( $pdo, $userid);
        $success = [];
        
        $success['wishlist_deleted'] = "Wishlist Deleted";

        $_SESSION["wishlist"] = $success;

        header("Location: ../wishlist.php?wishlist=deleted");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }
   

}


if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['save_multiple'])) {
   
    $productids = $_POST["shoeid"];
    $userid = $_POST["userid"];

    try {
        require_once 'dbh.inc.php';
        require_once 'wishlist_model.inc.php';
        require_once 'wishlist_contrl.inc.php';
        include_once 'config_session.inc.php';
        
        $errors = [];

        if (empty($productids)) {
            $errors['noshoes'] = "No shoes Selected";
        } 
        if (empty($userid)) {
            $errors['nouser'] = "";
        } 

        

        if ($errors) {
            $_SESSION["errors_addtocartwish"] = $errors;

          
           
            header("Location: ../wishlist.php");
            die();
        }
       
       wishlist_to_cart( $pdo,  $productids, $userid);
        $success = [];
        
        $success['wishlist_cart'] = "Wishlist products Added to cart";

        $_SESSION["wishcart"] = $success;

        header("Location: ../wishlist.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}



