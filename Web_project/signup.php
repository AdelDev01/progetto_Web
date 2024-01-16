<!DOCTYPE html>
<html lang="it">
<!-- Questo è il codice che precedentemente era stato usato in login.html (solo la parte di registrazione)-->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
<?php require_once 'header.php'?>

    <div>
        <h1 id="titolo_registrazione">REGISTRAZIONE</h1>

        <p>Inserire email, username e password: </p>
        <form action="file php per la registrazione" method="post">

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

</body>
</html>