<?php

// IF per fare in modo che si possa accedere alla pagina solo tramite pulsante

if(isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
// connessione al db e scaricamento del file con le funzioni per effettuare il controllo errori
    require_once '../connection.php';
    require_once 'functions.inc.php';

// diversi controlli per evitare che i campi siano invalidi (per un qualsiasi motivo)

    if (emptyInputSignup($username, $email, $pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit(); 
    }

    if (invalidStringInput($username) !== false) {
        header("location: ../signup.php?error=invalidusername");
        exit(); 
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit(); 
    }

    if (fieldMatch($pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit(); 
    }

    if (usernameExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit(); 
    }
    createUser($conn, $username, $email, $pwd);
 

}
else{
    header("location: ../signup.php");
    exit();
}