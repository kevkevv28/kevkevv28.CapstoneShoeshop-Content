<?php

    require_once 'includes/config_session.inc.php';
    if(!isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing wishlist";
        header("Location: loginPage.php");

    }
    include('includes/header.php');

    require_once 'includes/dbh.inc.php';
    include('includes/cart_model.inc.php');
    include('includes/cartmodal.php');



    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
        $selectedItems = $_POST['shoeid'] ?? [];
        $shoeData = [];

        foreach ($selectedItems as $shoeId) {
            $shoeData[] = [
                'shoe_id' => $_POST['shoe_id'][$shoeId],
                'size' => $_POST['size'][$shoeId],
                'quantity' => $_POST['quantity'][$shoeId],
            ];
        }

        // Now you have an array of selected shoes with their details.
        // You can use this data as needed (e.g., save to the database, process the order, etc.)

        // Example output
        #print_r($shoeData);
    }
    ?>
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
                
                include_once 'includes/login_model.inc.php';

                $result = get_user_topbar($pdo, $_SESSION['user_id']);
                $cartcount = get_cart_count($pdo, $_SESSION['user_id']);
                $wishcount = get_wishlist_count($pdo, $_SESSION['user_id']);
                $addressResult = get_user_address_for_checkout($pdo, $_SESSION['user_id'])
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








<div class="container-fluid d-flex p-0">


    <div class="for-adress-and-payment border">
        
        <div class="container d-flex pt-2">
            <div class="for-each-in-ap border">
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

        <div class="container d-flex pt-2">
            <div class="for-each-in-ap border">
                <h5>Ship to</h5>
                <div>
                    <p class="ml-5">

                        <?php echo $addressResult['email'] ?>
                        
                    </p>
                </div>
            </div>
        </div> 

        <div class="container pt-2 mb-5">
        <div class="for-each-in-ap border"></div>
        </div>   

        <div class="container pt-2 mb-1">
        <div class="for-each-in-payment border"></div>
        </div>
        
        <div class="container pt-2 ">
        <div class="for-each-in-payment border"></div>
        </div>  
        

    </div>


    <div class="for-selected-product border">
        
        <div class="container pt-2">
            <div class="for-each-product border"></div>
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
    <!-- End Slider Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

