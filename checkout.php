<?php
require_once 'includes/config_session.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
        $shoeData = [];

        if (isset($_POST['shoe_id']) && is_array($_POST['shoe_id'])) {
            foreach ($_POST['shoe_id'] as $shoeId => $value) {
                $shoeData[] = [
                    'shoe_id' => $shoeId,
                    'size' => $_POST['size'][$shoeId] ?? '',
                    'quantity' => $_POST['quantity'][$shoeId] ?? '',
                ];
            }
        }

       
    }

    if(empty($shoeData)){
        $_SESSION['no_shoes'] = "No selected shoes";
        header("Location: addToCardPage.php");
        die();
    }   

    
    
    if(!isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing wishlist";
        header("Location: loginPage.php");

    }
    
    include('includes/header.php');

    require_once 'includes/dbh.inc.php';

    include_once 'includes/checkout_model.inc.php';
    $total = 0; // Initialize total amount
    foreach($shoeData as $shoe){
        $shoedetail = get_shoes_detail($pdo, $shoe['shoe_id']);
         // Calculate the price for this item (price * quantity)
                
                $itemTotal = $shoedetail['price'] * $shoe['quantity'];
                $total += $itemTotal; // Add to total
    }

    
    
     ?>
     <script
            src="https://www.paypal.com/sdk/js?client-id=Ady7thazPzKwsKSz_XM0lXq74fR6K0S0l6lird0zJvzwy5X88w3A9hD77qBkG_aDYa15oBlxAsXMtSyV&currency=PHP&components=buttons&disable-funding=venmo,paylater,card"
            data-sdk-integration-source="developer-studio"
        ></script>
    <!-- Header --><nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">

<a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
DLJPS
<p class="small-text">Footwear Shop</p>
</a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
        <div class="flex-fill">
            
        </div>
        <div class="navbar align-self-center d-flex">
            <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                    <div class="input-group-text">
                        <i class="fa fa-fw fa-search"></i>
                    </div>
                </div>
            </div>
            
            
            
            
            <?php 
            
            if(!isset($_SESSION['user_id'])){
               
            
                ?>
                <a class="nav-icon position-relative text-decoration-none" href="addToCardPage.php">
                <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
            </a>

                <a class="nav-icon position-relative text-decoration-none" href="wishlist.php">
                <i class="fa fa-fw fa-heart text-dark mr-1"></i>
                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
            </a>


                <a class="nav-icon position-relative text-decoration-none" href="loginPage.php">
                <i class="fa fa-fw fa-user text-dark mr-3"></i>
                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark  " style="margin-left: 20px;">Login Here!</span>
            </a>
            <?php

            }else{
                
                

                $result = get_user_topbar($pdo, $_SESSION['user_id']);
                
                $addressResult = get_user_address_for_checkout($pdo, $_SESSION['user_id']);
                $address =  $result['first_name'] ." " . $result['last_name'] . " , ". $addressResult['address'] . " , " . $addressResult['zipcode'] .  $addressResult['mobile_no']. "  Additional Info:" . $addressResult['brgy_street'] ;
                            
                
                ?>
               

                <div class="nav-item dropdown">
                <a class="nav-icon position-relative text-decoration-none" href="addToCardPage.php">
                        <i class="fa fa-shopping-cart text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>


                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profilePage.php">User Profile</a>
                        <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                    </div>
                </div>
            <?php
            }



           
            ?>

           
            
            
            
           

        </div>
    </div>

</div>
</nav><!-- Close Header -->








<div class="container-fluid-checkout d-flex p-0">


    <div class="for-adress-and-payment border">
        
        <div class="container d-flex pt-3 mb-5">
            <div class="for-each-in-ap ">
                <div class="checkout-card shadow-sm p-4">
                <h5>Account</h5>
                <div>
                <p class="ml-5">
                    <?php echo $result['email'] ?>
                    <span style="float: right;">
                        <a class="textdeco mr-3" href="includes/logout.inc.php"><u>Logout</u></a>
                    </span>
                </p>
                </div>
            </div>
        </div>
        </div>

        <div class="container d-flex pt-2 mb-5">
            <div class="for-each-in-ap mt-3">
                <div class="checkout-card shadow-sm p-4">
                <h5>Ship to <span class="default-address-checkout "> ( default address ) </span></h5>
                <div>  
                    <?php if (empty($addressResult)){?>
                    <p class="ml-5">
                        Address not Available <br>
                        <a href="adressPage.php" class="textdeco ml-5 pl-5 ">* click here to Add an Address * </a>
                        
                    </p>

                    <?php }else{?>
                        <p class="ml-5 check_out_small_letter">
                        
                        <?php echo $result['first_name'] ." " . $result['last_name'] . " , ". $addressResult['address'] . " , " . $addressResult['zipcode'] .  $addressResult['mobile_no']?>
                        <br>
                        additional info:  <?php echo $addressResult['brgy_street'] ?>
                        
                        </p>
                   <?php } ?>
                </div>
                    </div>
            </div>
        </div> 

        <div id="checkout-page">
            <div class="container forcheck py-4 mt-3">
                <div class="checkout-card shadow-sm p-4">
                    <h5 class="mb-4  text-uppercase font-weight-bold">
                        Payment
                    </h5>
                    <form method="POST" action="includes/checkout.inc.php">
                        <div class="payment-option mb-3 d-flex align-items-center border rounded p-3">
                            <input type="radio" id="cod" name="payment_method" value="COD" required class="custom-radio">
                            <label for="cod" class="ml-3 d-flex flex-column w-100">
                                <span class="font-weight-bold">
                                    <i class="fa fa-money text-success mr-2"></i>
                                    Cash on Delivery (COD)
                                </span>
                                <small class="text-muted">Pay directly to the courier upon delivery.</small>
                            </label>
                        </div>
                        <div class="payment-option mb-3 d-flex align-items-center border rounded p-3">
                            
                            <input type="radio" id="paypal" name="payment_method" value="PayPal" class="custom-radio">
                            <label for="paypal" class="ml-3 d-flex flex-column w-100">
                                <span class="font-weight-bold">
                                    <i class="fa fa-paypal text-primary mr-2"></i>
                                    Secure Payment using PayPal
                                </span>
                                <small class="text-muted">Use your PayPal account for a fast and secure checkout.</small>
                            </label>
                        </div>

                        
                         <input type="hidden" name="address" value="<?php echo $address ?>">
                        <?php foreach ($shoeData as $shoe){
                            $shoedetail = get_shoes_detail($pdo, $shoe['shoe_id']);
                            ?>
                        
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id'] ?>">
                        <input type="hidden" name="shoeid[]" value="<?php echo $shoe['shoe_id'] ?>">
                        <input type="hidden" name="sizes[<?php echo htmlspecialchars($shoe['shoe_id']); ?>]" value="<?php echo htmlspecialchars($shoe['size']); ?>">
                        <input type="hidden" name="qty[<?php echo htmlspecialchars($shoe['shoe_id']); ?>]" value="<?php echo $shoe['quantity']; ?>">
                       <input type="hidden" name="total[<?php echo htmlspecialchars($shoe['shoe_id']); ?>]" value="<?php echo $shoedetail['price']?>">

                        <?php } ?>
                        <button type="submit" id="payment-btn" class="btn btn-success btn-block mt-4"   >
                            Select Payment Method
                        </button>

                          <!-- PayPal button container, initially hidden -->
                    <div id="paypal-button-container" style="display: none;">
                        <!-- Add your PayPal button integration code here -->
                    </div>

                     <p id="result-message"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>












    <div class="for-selected-product " >
        <div class="container py-3">

            
        <div class="checkout-cards shadow-sm p-4 " >
                <h5 class="text-uppercase font-weight-bold mb-3">Selected Product</h5>
                
                

                <?php 
                

                foreach ($shoeData as $shoe) { 
                    
                // Fetch the shoe details
                $shoedetail = get_shoes_detail($pdo, $shoe['shoe_id']);
                if (!$shoedetail) {
                    // Handle unavailable product case
                    echo "<p>Product not available.</p>";
                    continue;
                }

                
                ?>
                <div class="for-each-product marginbottom-checkout">
                    <!-- Example Product Item -->
                    <div class="d-flex align-items-center border rounded  p-3 ">
                        <img src="assets/shoesphotos/<?php echo htmlspecialchars($shoedetail['product_img_name']); ?>" 
                            alt="Product Image" 
                            class="img-fluid rounded" 
                            style="width: 80px; height: 80px;">
                        <div class="ml-3 w-100">
                            <h6 class="mb-1 text-dark font-weight-bold">
                                <?php echo htmlspecialchars($shoedetail['product_name']); ?>
                            </h6>
                            <p class="mb-1 text-muted small">
                                Category: <?php echo htmlspecialchars($shoedetail['category']); ?>
                            </p>
                            <p class="mb-1 text-muted smaller">
                                Size: <?php echo htmlspecialchars($shoe['size']); ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-success font-weight-bold">
                                    ₱<?php echo number_format(($shoedetail['price'] * $shoe['quantity']), 2); ?>
                                </span>
                                <span class="text-muted small">
                                    Quantity: <?php echo htmlspecialchars($shoe['quantity']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
                

                
                <!-- Total -->
                <div class="total-container">
                    <p class="text-muted small">Total: <span class="text-success font-weight-bold">₱<?php echo number_format($total, 2); ?></span></p>
                </div>
            </div>
        </div>
    </div>


    
</div>



















 <!-- footer -->


    <!-- Back to Top Button -->
    <button id="backToTopBtn" class="btn btn-primary btn-lg">
    <i class="fa fa-arrow-up"></i>
</button>
    <!-- End of scroll up -->


      <!-- Start Script -->
      <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes 
    <script src="dist/js/demo.js"></script>-->
    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery and Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- jQuery and Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
     <!-- DataTables  & Plugins -->
     <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/jszip/jszip.min.js"></script>
    <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    
    <script>
        var messageText = "<?= $_SESSION['statusemail'] ?? ''; ?>";
        if(messageText != ''){

            Swal.fire({
                
                title: "Thank you",
                text: messageText,

                });
       
        <?php unset($_SESSION['statusemail']); ?>
        }
        
        
    </script>

    <!-- Start Slider Script -->
    <script src="assets/js/slick.min.js"></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    
    <script>

        document.addEventListener("DOMContentLoaded", function () {
        const codRadio = document.getElementById("cod");
        const paypalRadio = document.getElementById("paypal");
        const paymentButton = document.getElementById("payment-btn");
        const paypalButtonContainer = document.getElementById("paypal-button-container");

        if (!codRadio || !paypalRadio || !paymentButton || !paypalButtonContainer) {
            console.error("One or more elements are missing in the DOM.");
            return;
        }

        // Function to update button text, name attribute, and toggle visibility
        function updatePaymentButton(newText, newName) {
            // Update button text with animation
            paymentButton.classList.add("fade-out-checkout");

            setTimeout(() => {
                paymentButton.textContent = newText;

                // Update the name attribute
                paymentButton.setAttribute("name", newName);

                paymentButton.classList.remove("fade-out-checkout");
                paymentButton.classList.add("fade-in-checkout");

                setTimeout(() => {
                    paymentButton.classList.remove("fade-in-checkout");
                }, 400);
            }, 400);
        }

        // Function to toggle visibility between payment button and PayPal button container
        function togglePaymentMethod() {
            if (paypalRadio.checked) {
                paymentButton.style.display = "none"; // Hide payment button
                paypalButtonContainer.style.display = "block"; // Show PayPal container
            } else {
                paymentButton.style.display = "block"; // Show payment button
                paypalButtonContainer.style.display = "none"; // Hide PayPal container
            }
        }

        // Event listeners for radio buttons
        codRadio.addEventListener("change", () => {
            updatePaymentButton("Complete Order", "codbtn");
            togglePaymentMethod();
        });

        paypalRadio.addEventListener("change", () => {
            updatePaymentButton("Pay Now", "paypalbtn");
            togglePaymentMethod();
        });

        // Initial call to set default button text and visibility based on initial state
        const defaultText = codRadio.checked ? "Complete Order" : paypalRadio.checked ? "Pay Now" : "Select Payment Method";
        const defaultName = codRadio.checked ? "codbtn" : paypalRadio.checked ? "paypalbtn" : "";
        updatePaymentButton(defaultText, defaultName);
        togglePaymentMethod();
    });





</script>
 
        <script src="assets/js/app.js"></script>
    <!-- End Slider Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

