<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST["first_name"];
    $lastname = $_POST["last_name"];
    $pwd = $_POST["pwd"];
    $cpwd = $_POST["cpwd"];
    $email = $_POST["email"];
    $num = $_POST["num"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        //ERROR HANDLERS 

        $errors = [];

        if (is_input_empty($firstname, $lastname, $pwd, $email, $num)) {
            $errors['emptyinput'] = "Empty Imput please Fill all fields";
        } 
        if(pwd_is_not_same($pwd, $cpwd)){
            $errors['notsamepwd'] = "Password do not match"; 
        }

        if(is_valid_email($email)){
            $errors['invalidemail'] = "Invalid email please type valid email";
        }

        if(is_email_taken($pdo, $email)){
            $errors['email_taken'] = "Email is already Registered!";
        }
        
        if(num_valid($num)){
            $errors['numInvalid'] = "Only Accept 11 digit number! Please start with 09";
        }

        include_once 'config_session.inc.php';

        if ($errors) {
             $_SESSION["errors_signup"] = $errors;

            $signup_data = [
                "first_name" => $firstname,
                "last_name" => $lastname,
                "email" => $email,
                "num" => $num
            ];

            $_SESSION["signup_data"] = $signup_data;
             header("Location: ../registerPage.php");
             die();
        }

        create_user( $pdo,  $firstname, $lastname,  $pwd,  $email, $num);

        header("Location: ../registerPage.php?signup=Success");

        $pdo = null;
        $stmt = null;
        $signup_data = null;

        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

}else{
    header("Location: ../registerPage.php");
    die();
}