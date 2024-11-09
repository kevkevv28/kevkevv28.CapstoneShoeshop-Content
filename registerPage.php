<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup_view.inc.php';
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
    <form action="includes/signup.inc.php" method="POST" class="p-3 mt-3">
        <?php signup_inputs() ?>
        <button class="btn mt-3">Register</button>
    </form>
    <div class="text-center fs-6">
        Already a member? <a class="marginleftalittle" href="loginPage.php">Login</a>
    </div>

    <div class="text-center fs-6 errorcenter">
        <?php check_signup_errors(); ?>
    </div>
    
</div>



<?php include('includes/footer.php'); ?>