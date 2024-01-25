<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Moirai+One&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/073667f4ba.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    </head>

    <body>

        <div class="navigator">
                <div class="logo">
                    <a href="homepage.php" id="logo">Booket</a>
                </div>
                <div id="nav_btns">
                 <ul>
                 <?php
                    if (isset($_SESSION['username'])){
                        echo '<li><a class="link_nav-bar" href="./profilo.php" >PROFILO</a></li>';
                        echo '<li><a class="link_nav-bar" href="./includes/logout.inc.php">LOGOUT</a></li>';
                    }
                    else{
                        echo '<li><a class="link_nav-bar" href="./login.php"><i class="fa-solid fa-right-to-bracket"></i>  LOGIN</a></li>';
                        echo '<li><a class="link_nav-bar" href="./signup.php"><i class="fa-solid fa-user-plus"></i>  REGISTRAZIONE</a></li>';
                    }
                ?>
                 </ul>
                </div>
            </div>

    </body>
</html>