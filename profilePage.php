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
    include('includes/topbar.php');
    $profileresult = get_user_topbar($pdo, $_SESSION['user_id']);
    $addresscount = get_address_count($pdo, $_SESSION['user_id']);
?>

<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">MY ACCOUNT</h1>
            <button type="button" class="btn btn-secondary btnlogut" onclick="Redirecttologout()"> Log out </button>
        </div>
    </div>

 <!-- Start Contact -->
 <div class="container py-5">
        <div class="row py-5">

                <div class="row">
                    <div class="form-group col-md-6 mb-3  left">
                        <h3 class="">ORDER HISTORY</h3>
                        <p>
                            
                        </p>
                    </div>

                    <div class="form-group col-md-6 mb-3 right ">
                        <h3 class="">Acount Details</h3>
                        <p>  
                            <span class="mr-5 ">  <?php echo $profileresult["first_name"] . " " . $profileresult["last_name"] ?> </span> <br>
                            <span class="mr-n4"> <?php echo $profileresult["email"] ?> </span>
                        </p>
                        <a href="adressPage.php" class="textdeco mr-n2"> View Addresses ( <?php echo $addresscount['addresscount'] ?> )</a>
                    </div>
                </div>
                
        </div>
        
    </div>
    <!-- End Contact -->

<script>

function Redirecttologout(){
    window.location.href = "includes/logout.inc.php";
}
</script>
<?php include('includes/footer.php'); ?>