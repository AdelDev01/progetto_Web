<!DOCTYPE html>
<html lang="it">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="login-signup-profile.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/073667f4ba.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once 'header.php'?>
    <div class="container-sign-up">
        <div class="box">
            <div id="div_registrazione">
                <i class="fa-solid fa-users"></i>
                <h1 id="titolo_registrazione">REGISTRAZIONE</h1>
            </div>

                <form action="./includes/signup.inc.php" method="post">
                    <div id="form_registrazione">
                        <input type="email" name="email" placeholder="Inserisci la tua email"></input>
                        <br><br>
                        <input type="text" name="username" placeholder="Inserisci il tuo username"></input>
                        <br><br>
                        <input type="password" name="pwd" placeholder="Inserisci la tua password"> </input>
                        <br><br>
                        <input type="password" name="pwdrepeat" placeholder="Ripeti la tua password"> </input>
                        <br><br>
                        <button type="submit" name="submit">Registrati</button>
                    </div>
                </form>
        </div>

        <div id="messaggi_errori">
            <!-- Gestione errori nella registrazione -->
        <?php
            if (isset($_GET['error'])) {
                if($_GET['error'] == 'emptyinput'){
                    echo '<p>Riempi tutti i campi!</p>';
                }
                if($_GET['error'] == 'invalidusername'){
                    echo '<p>Username non valido! Inserisci solo caratteri alfanumerici!</p>';
                }
                if($_GET['error'] == 'invalidemail'){
                    echo '<p>Email non valida! Inserisci solo caratteri alfanumerici!</p>';
                }
                if($_GET['error'] == 'passwordsdontmatch'){
                    echo '<p>Le password non combaciano!</p>';
                }
                if($_GET['error'] == 'usernametaken'){
                    echo '<p>Username o mail non disponibile!</p>';
                }
                if($_GET['error'] == 'stmtfailed'){
                    echo '<p>Qualcosa è andato storto, prova di nuovo</p>';
                }
                if($_GET['error'] == 'none'){
                    echo '<p>Registrazione effettuata con successo!</p>';
                }
            }
        ?>
    </div>
    <?php require_once 'footer.php'?>

</body>

</html>