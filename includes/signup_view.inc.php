<?php

 declare(strict_types=1);

function signup_inputs(){
    
    
   
    if (isset($_SESSION["signup_data"]["first_name"])){
        echo '<div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="first_name" id="first_name" placeholder="First name" value="'. $_SESSION["signup_data"]["first_name"] .'" >
        </div>';
        unset($_SESSION["signup_data"]["first_name"]);
    }else{
        echo '<div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="first_name" id="first_name" placeholder="First Name">
        </div>';
        unset($_SESSION["signup_data"]["first_name"]);
    }

    if (isset($_SESSION["signup_data"]["last_name"])){
        echo '<div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="'. $_SESSION["signup_data"]["last_name"] .'" >
        </div>';
        unset($_SESSION["signup_data"]["last_name"]);
    }else{
        echo '<div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="last_name" id="last_name" placeholder="Last Name">
        </div>';
        unset($_SESSION["signup_data"]["last_name"]);
    }

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_taken"]) && !isset($_SESSION["errors_signup"]["invalidemail"])){
        echo '<div class="form-field d-flex align-items-center">
            <span class="fas fa-envelope"></span>
            <input type="email" name="email" id="email" placeholder="Email" value="'. $_SESSION["signup_data"]["email"] .'">
        </div>';
        unset($_SESSION["signup_data"]["email"]);
    }else{
        echo ' <div class="form-field d-flex align-items-center">
            <span class="fas fa-envelope"></span>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>';
        unset($_SESSION["signup_data"]["email"]);
    }

    echo '<div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="pwd" id="pwd" placeholder="Password">
        </div>';
    echo '<div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="cpwd" id="cpwd" placeholder="Confirm Password">
        </div>';

    

    if (isset($_SESSION["signup_data"]["num"]) && !isset($_SESSION["errors_signup"]["numInvalid"])){
        echo '<div class="form-field d-flex align-items-center">
            <span class="fas fa-phone"></span>
            <input type="number" name="num" id="num" placeholder="Contact Number" value="'. $_SESSION["signup_data"]["num"] .'">
        </div>';
        unset($_SESSION["signup_data"]["num"]);
    }else{
        echo ' <div class="form-field d-flex align-items-center">
            <span class="fas fa-phone"></span>
            <input type="number" name="num" id="num" placeholder="Contact Number">
        </div>';
        unset($_SESSION["signup_data"]["num"]);
    }

}

 function check_signup_errors(){
    if(isset($_SESSION["errors_signup"])){
        $errors = $_SESSION["errors_signup"];

        echo "<br>";
        foreach ($errors as $error) {
            echo "<p class='errorsSignup'> " . $error . "</p>";
        }

        unset($_SESSION["errors_signup"]);
    }else if (isset($_GET["signup"]) && $_GET["signup"] === 'Success' ){
        echo "<br>";
        echo "<div class='alert alert-success alert-dismissible ml-5'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h5><i class='icon fas fa-check'></i> Registration Successful!</h5>
                  Redirecting to Login Page in <span id='countdown'>3</span> seconds.
                </div>";

        
    }
 }

