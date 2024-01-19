<?php session_start(); ?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TicketSell</title>
        <link rel="stylesheet" href="header.css">
    </head>

    <body>

        <div class="navigator">
                <div id="logo">
                    <a href="homepage.php">TicketSell</a>
                </div>
                <div id="nav_btns">
                 <ul>
                 <?php
                    if (isset($_SESSION['username'])){
                        // echo '<li><a class="link_nav-bar" href="../img/impostazioni.php">IMPOSTAZIONI ACCOUNT</a></li>';
                        echo '<li><a class="link_nav-bar" href="./profilo.php" >PROFILO</a></li>';
                        echo '<li><a class="link_nav-bar" href="./includes/logout.inc.php">LOGOUT</a></li>';
                    }
                    else{
                        echo '<li><a class="link_nav-bar" href="./login.php">LOGIN</a></li>';
                        echo '<li><a class="link_nav-bar" href="./signup.php">REGISTRAZIONE</a></li>';
                    }
                ?>
                 </ul>
                </div>
            </div>

    </body>
</html>