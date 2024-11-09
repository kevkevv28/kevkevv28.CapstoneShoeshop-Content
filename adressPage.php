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

    include('includes/topbar.php');
    include_once 'includes/AddressAddmodal.php';
   
?>

<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">ADDRESS PAGE</h1>
            <button type="button" id="btnadd" class="btn btn- btnadress"> CHANGE ADDRESS </button>
        </div>
    </div>

 <!-- Start Contact -->
 <div class="container py-5">
        <div class="row py-5">
            
                <div class="row">
                    <div class="border center">
                        <h3 class="center">ORDER HISTORY</h3>
                        <p>
                            sss
                        </p>
                    </div>
                </div>
                
        </div>
        
    </div>
    <!-- End Contact -->


    <script>
    document.addEventListener('DOMContentLoaded', function () {

    // When the user clicks the "Add To Wishlist" button, trigger the modal
    document.getElementById('btnadd').addEventListener('click', function () {
        // Show the modal
        var addresslistModal = new bootstrap.Modal(document.getElementById('addressModal'));
        addresslistModal.show();
    });


    });
    </script>

<?php include('includes/footer.php'); ?>