<?php
$servername = "localhost:3306";
$dBUsername = "root";
$dBPassword = "";
$dBName = "progettoweb_mobile";

//  connessione al DB

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// Messaggio di errore in caso fallisca la connessione

if (!$conn){
    die("Connessione fallita: " . mysqli_connect_error());
}