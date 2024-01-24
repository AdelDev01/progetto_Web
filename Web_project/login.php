<?php
session_start();
    if (isset($_SESSION['username'])){
        header("location: ./homepage.php?error=alreadylogged");
        exit();
    }
    
    // Gestione errori php
    if (isset($_GET['error'])) {
        if($_GET['error'] == 'emptyinput'){
            $errorMessage = 'Riempi tutti i campi!';
        }
        if($_GET['error'] == 'wronglogin'){
            $errorMessage = 'Utente non esistente!';
        }
        if($_GET['error'] == 'incorrectpassword'){
            $errorMessage = 'La mail o la password non è corretta!';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="it">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="login-signup-profile.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        
        <script src="https://kit.fontawesome.com/073667f4ba.js" crossorigin="anonymous"></script>
        <script src="./functions.js"></script>

    
    </head>
    <body>

        <?php require_once 'header.php';// apre subito il popup se ci sono errori
        if(!empty($errorMessage)) : ?>
            <script> window.onload = openDialog; </script> 
        <?php endif; ?>

        <!-- Contenuto del popup -->
        <dialog id="myDialog">
            <p><?php echo $errorMessage; ?></p>
            <button onclick="closeDialog()">Chiudi</button>
        </dialog>
        <div class="container-login">
            <div class="box">
                <div id="div_login">
                    <i class="fa-regular fa-user"></i>
                    <h1 id="titolo_login">LOGIN</h1>
                </div>
            

                <form action="includes/login.inc.php" method="post">
                    <div id="form_login">
                        <input type="text" name="username" placeholder="Inserisci username o email">
                        <br><br>
                        <input type="password" name="password" placeholder="Inserisci la tua password">
                        <br><br>
                        <button type="submit" name="submit">Accedi</button>
                    </div>

                    <div id="registrati_ora">
                        <p style='display: inline'>Non sei ancora registrato?</p>
                        <a href="./signup.php" id="pulsante-registrazione">Registrati ora</a>
                    </div>
                </form>
            </div>

        <?php require_once 'footer.php'?>

    </body>
</html>