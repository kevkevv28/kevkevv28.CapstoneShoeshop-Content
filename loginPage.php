<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/login_view.inc.php';
    if (isset($_SESSION['pleaselogin'])) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Please Login to Continue!',
                    text: '',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>";
        
        unset($_SESSION['pleaselogin']);
    }

    if(isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing the shoes";
        header("Location: index.php");

    }
?>


<?php


include('includes/header.php');
include('includes/topbar.php');
?>
<div class="login1-wrapper">
    <div class="logo">
        <img src="assets/img/logo.jpg" alt="shoestore">
    </div>
    <div class="text-center mt-4 name">
        DLJPS Streetwear Shop
    </div>
    <form action="includes/login.inc.php" method="POST" class="p-3 mt-4">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="text" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="pwd" id="pwd" placeholder="Password">
        </div>
        <button class="btn mt-3">Login</button>
    </form>
    <div class="text-center fs-6">
        Don't have an account? <a class="marginleftalittle" href="registerPage.php">Sign up</a>
    </div>
    <div class="text-center fs-6 marginupLoginRegister">
        
    </div>

    <div class="text-center fs-6 errorcenter mr-5">
        <?php check_login_errors(); ?>
    </div>
</div>
    


    
<?php include('includes/footer.php'); ?>