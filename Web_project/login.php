<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <?php require_once 'header.php'?>

        <div id="div_login">
            <h1 id="titolo_login">LOGIN</h1>
            <p>Inserire nome utente e password: </p>
        </div>

        <form action="file php per il login" method="post">
            <div id="form_login">
                <input type="text" name="username" placeholder="Inserisci username o email">
                <br><br>
                <input type="password" name="password" placeholder="Inserisci la tua password">
                <br><br>
                <button type="submit" name="submit">Accedi</button>
            </div>

            <div id="registrati_ora">
                <p style='display: inline'>Non sei ancora registrato?</p>
                <a href="./registration.php">Registrati ora</a>
            </div>
        </form>
        
        <?php require_once 'footer.php'?>

    </body>
</html>