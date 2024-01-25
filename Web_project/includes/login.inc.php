<?php 
// controllo per evitare che si acceda a questo file se non tramite pulsante apposito
if(isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $pwd = $_POST["password"];
// connessione al db e scaricamento del file con le funzioni per effettuare il controllo errori
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