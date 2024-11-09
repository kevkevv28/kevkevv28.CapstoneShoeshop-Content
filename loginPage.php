<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/login_view.inc.php';
    if (isset($_SESSION['pleaselogin'])) {
        echo "<script>alert('" . $_SESSION['pleaselogin'] . "');</script>";
        
        unset($_SESSION['pleaselogin']);
    }
?>


<?php

    if (!isset($_SESSION['user_id'])){ ?>
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
            <span class="far fa-user"></span>
            <input type="text" name="username" id="username" placeholder="Username">
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
</div>

<?php
    }else{
        $_SESSION["already"] = "Already Logged In";
       header("Location: index.php");
       exit();
    }
    ?>


    
<?php include('includes/footer.php'); ?>