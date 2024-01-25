<?php 
//non molto da dire, file per il logout
session_start();
session_unset();
session_destroy();
header("location: ../homepage.php");
exit();