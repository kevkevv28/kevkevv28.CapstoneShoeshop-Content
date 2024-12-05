<?php 


if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['cancel'])) {
    $order_id = $_POST["order_id"];

   
    try {
        require_once 'dbh.inc.php';
        require_once 'profile_model.inc.php';
        include_once 'config_session.inc.php';
       
        
        cancel_order( $pdo, $order_id);
        $success = [];
        
        $success['order_cancel'] = "Order Cancelled successfuly";

        $_SESSION["order"] = $success;

        header("Location: ../profilePage.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }
   

}

if ($_SERVER["REQUEST_METHOD"] === "POST"  && isset($_POST['cancel_paypal'])) {
    $order_id = $_POST["order_id"];
    $price = $_POST["price"];


    echo $order_id . $price;

    die();

   
    try {
        require_once 'dbh.inc.php';
        require_once 'profile_model.inc.php';
        include_once 'config_session.inc.php';
       
        
        cancel_order( $pdo, $order_id);
        $success = [];
        
        $success['order_cancel'] = "Order Cancelled successfuly";

        $_SESSION["order"] = $success;

        header("Location: ../profilePage.php");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }
   

}
