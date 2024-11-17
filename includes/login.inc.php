<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //ERROR HANDLERS 

        $errors = [];

        if (is_input_empty($email, $pwd )) {
            $errors['emptyinput'] = "Empty Imput please Fill all fields";
        }

        $result = get_user($pdo, $email);

        if (is_username_wrong($result)){
            $errors['login_incorrect'] = "Incorrect login info!";
        }
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
            $errors['login_incorrect'] = "Incorrect login info!";
        }
        


        include_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

             header("Location: ../loginPage.php");
             die();
        }
        
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        $_SESSION["last_regeneration"] = time();

        $success = [];
        
        $success['login_success'] = "Login Successfully";
        $_SESSION["success_login"] = $success;
        
        
        header("Location: ../index.php?login=success");
        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e ) {
        die("Query Failed: " . $e->getMessage());
    }

}else{
    header("Location: ../loginPage.php");
    die();
}