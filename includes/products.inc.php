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
     
        $checkifadded = get_product_cart($pdo, $productid, $usersid);
        

        $errors = [];


        


        if (empty($size)) {
            $errors['sizeNotSelected'] = "Product Size not Selected ";
        } 

        if($checkifadded){
            $_SESSION['Shoes_already'] = "The shoe is already in your cart";
            header("Location: ../product_single.php?prodid=". $productid. "");
            die();
        }
       
        if ($errors) {
            $_SESSION["errors_product"] = $errors;

          
           
            header("Location: ../product_single.php?prodid=". $productid. "");
            die();
        }
        /*
         $checkavailable = get_product_stock($pdo, $productid, $size);
        
        if ($checkavailable == "Unavailable") {
            $_SESSION['Unavailable'] = "Unavailable Shoe Stocks Please contact Admin";
            header("Location: ../product_single.php?prodid=$productid");
            die();
        }
        */
        
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





if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addaddress'])) {
    
    $usersid = $_POST["user_id"];
    $address = $_POST["address"];
    $streetandbrgy = $_POST["streetandbrgy"];
    $city = $_POST['city'];
    $postal = $_POST["postal"];  
    $phone = $_POST["phone"];
    $default = $_POST['default'];
  
    try {
        require_once 'dbh.inc.php';
        require_once 'products_model.inc.php';
        require_once 'products_contrl.inc.php';
        include_once 'config_session.inc.php';
        //ERROR HANDLERS    
        
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

       if(isset($default)) {
            make_all_address_default_to_zero( $pdo, $usersid);
            save_address($pdo, $usersid, $address, $streetandbrgy, $city, $postal, $phone, $default);
       }else{
            save_address($pdo, $usersid, $address, $streetandbrgy, $city, $postal, $phone );
       }
       
       
        
        $success = [];
        
        $success['Address_added'] = "Address Successfully added";
        $_SESSION["address_success"] = $success;

        header("Location: ../adressPage.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}
        
    



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Editaddress'])) {
    

    $id = $_POST["id"];
    $usersid = $_POST["user_id"];
    $address = $_POST["address"];
    $streetandbrgy = $_POST["streetandbrgy"];
    $city = $_POST['city'];
    $postal = $_POST["postal"];  
    $phone = $_POST["phone"];
    $default = $_POST['default'];
    
    try {
        require_once 'dbh.inc.php';
        require_once 'products_model.inc.php';
        require_once 'products_contrl.inc.php';
        include_once 'config_session.inc.php';
        //ERROR HANDLERS    
        
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

       if($default != null) {
            make_all_address_default_to_zero( $pdo, $usersid);
            edit_address($pdo, $id, $usersid, $address, $streetandbrgy, $city, $postal, $phone, $default);
       }else{
            edit_address($pdo, $id, $usersid, $address, $streetandbrgy, $city, $postal, $phone );
       }
       
       
        
        $success = [];
        
        $success['Address_added'] = "Address Successfully added";
        $_SESSION["address_success"] = $success;

        header("Location: ../adressPage.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['deleteaddress'])) {
    $userid = $_POST["user_id"];
    $addressid = $_POST["id"];

    try {
        require_once 'dbh.inc.php';
        require_once 'products_model.inc.php';
        require_once 'products_contrl.inc.php';
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
        
        delete_address( $pdo, $userid, $addressid);
        $success = [];
        
        $success['Address_deleted'] = "Address Successfully Deleted";
        $_SESSION["address_success"] = $success;

        header("Location: ../adressPage.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}