<?php

session_start();
session_unset();
session_destroy();
session_start();
$success = [];
        
$success['logout'] = "Log Out Successfully";
$_SESSION["logout"] = $success;

header("Location: ../index.php");
die();