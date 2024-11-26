<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['codbtn'])) {
    $userid = $_POST["userid"];
    $product_ids = $_POST['shoeid'];
    $sizes = $_POST['sizes'];
    $quantity = $_POST['qty'];
    $total_amout = $_POST['total'];
    $address = $_POST['address'];
    $payment_status = 'COD';

    
    try {
        require_once 'dbh.inc.php';
        require_once 'checkout_model.inc.php';
        
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
        add_orders( $pdo, $userid, $product_ids, $sizes, $quantity, $total_amout, $address, $payment_status);
        remove_orders_from_cart( $pdo, $userid, $product_ids, $sizes, $quantity);
        $success = [];
        
        $success['Order_success'] = "Order Successfull, Thank you for Purchasing";

        $_SESSION["checkout_success"] = $success;

        header("Location: ../index.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }
   

}else{
    header("Location: ../checkout.php");
}