<?php
if(isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    require_once '../connection.php';
    require_once 'functions.inc.php';

    if (emptyInputCheck($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit(); 
    }

    loginUser($conn, $username, $pwd);
}
else{
    header("location: ../login.php");
    exit();
}