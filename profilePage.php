<?php
    require_once 'includes/config_session.inc.php';
    include('includes/header.php');
    if(!isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing wishlist";
        header("Location: loginPage.php");

    }
    if (isset($_SESSION['already'])) {
        echo "<div id='loginAlert'class='alert alert-warning alert-dismissible fade show' role='alert'>
                {$_SESSION['already']}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        // Unset the flash message after displaying it
        unset($_SESSION['already']);


    }
    include_once 'includes/login_model.inc.php';
    include_once 'includes/profile_model.inc.php';
    include('includes/topbar.php');
    $profileresult = get_user_topbar($pdo, $_SESSION['user_id']);
    $addresscount = get_address_count($pdo, $_SESSION['user_id']);
?>

<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">MY ACCOUNT</h1>
        <button type="button" class="btn btn-secondary btnlogut" onclick="Redirecttologout()"> Log out </button>
    </div>
</div>

<!-- Start Content -->
<div class="container height py-5">
    <div class="row pb-5 py-5">
        <div class="row">
            
        
            <div class="form-group col-md-6 mb-3 left">
                <h3 class="">ORDER HISTORY</h3>
                <div class="container history  p-5 ">
                    <div class="border order_history">
                    <?php 
                    
                    $orders = get_order_history($pdo, $_SESSION['user_id']);
                    
                    foreach ($orders as $order){
                    ?>
                    <div class="for-each-product marginbottom-checkout">
                        
 <!-- Example Product Item -->
                            <div class="d-flex align-items-center wider border rounded mt-n4 p-3 ">
                                <img src="assets/shoesphotos/<?php echo $order['product_img_name'] ?> " 
                                    alt="Product Image" 
                                    class="img-fluid rounded" 
                                    style="width: 80px; height: 80px;">
                                <div class="ml-3 w-100">
                                    <h6 class="mb-1 text-dark font-weight-bold">
                                        <?php echo htmlspecialchars($order['product_name']); ?>
                                    </h6>
                                    <p class="mb-1 text-muted smaller">
                                        Size: <?php echo htmlspecialchars($order['shoe_size']); ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-success font-weight-bold">
                                            ₱ <?php echo number_format(($order['price'] * $order['shoe_quantity']), 2); ?>
                                        </span>
                                        <span class="text-muted small">
                                            Quantity:  <?php echo htmlspecialchars($order['shoe_quantity']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        
                       
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>



            <div class="form-group col-md-6 mb-3 right">
                <h3 class="">Account Details</h3>
                <p>  
                    <span class="mr-5">  <?php echo $profileresult["first_name"] . " " . $profileresult["last_name"] ?> </span> <br>
                    <span class="mr-n4"> <?php echo $profileresult["email"] ?> </span>
                </p>
                <a href="adressPage.php" class="textdeco mr-n2"> View Addresses ( <?php echo $addresscount['addresscount'] ?> )</a>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->


<script>

function Redirecttologout(){
    window.location.href = "includes/logout.inc.php";
}
</script>

<?php include('includes/footer.php'); ?>