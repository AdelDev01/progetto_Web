<?php 
require_once './connection.php'; 
require_once './includes/functions.inc.php';

if (isset($_GET['error'])) {
    $errorMessage = '';

    if ($_GET['error'] == 'notlogged') {
        $errorMessage = "Non hai effettuato l'accesso!";
    }
    if ($_GET['error'] == 'alreadylogged') {
        $errorMessage = "Hai già effettuato l'accesso!";
    }
    if ($_GET['error'] == 'signupsuccess') {
        $errorMessage = 'Registrazione effettuata con successo!';
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booket</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kufam:ital,wght@1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <script src="./functions.js"></script>
    
</head>
<body>
    <?php require_once 'header.php';

    // apre subito il popup se ci sono errori
    if (!empty($errorMessage)) : ?>
        <script> window.onload = openDialog; </script> 
    <?php endif; ?>

    <!-- Contenuto del popup -->
    <dialog id="myDialog">
        <p><?php echo $errorMessage; ?></p>
        <button onclick="closeDialog()">Chiudi</button>
    </dialog>

    <div class="highlights-background">
        <section class="highlights">
            <?php
            $eventi = getEventInfoRandom($conn);
            foreach ($eventi as $evento) : ?>
                <div class="highlight-images">
                    <a href="evento.php?eventID=<?php echo $evento['id_evento']; ?>">
                        <div class="image">
                            <img src="<?php echo $evento['url_foto']; ?>" alt="" class="imag">
                        </div>
                        <div class="title">
                            <p class="event-name"><?php echo $evento['nome_evento']; ?></p>
                        </div>
                        <div class="datetime">
                            <p><?php echo $evento['data_evento']; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
   <div class="divisor">
   </div>
   <div class="event-title-dashboard">
        <p>DI TENDENZA IN QUESTO MOMENTO</p>
   </div>

   <!-- Ogni box equivale a un evento -->

   <div class="container">
        <div class="box-container">
            <?php
            $eventi = getEventInfoOrdered($conn, 'ASC');
            $counter = 0;  // Contatore per tracciare il numero di box visualizzati
            foreach ($eventi as $evento) :
                if ($counter >= 12) {
                    break;
                }
            ?>
                <div class="box">
                    <a href="evento.php?eventID=<?php echo $evento['id_evento']; ?>">
                        <div class="image">
                            <img src="<?php echo $evento['url_foto']; ?>" alt="" class="imag">
                        </div>
                        <div class="title">
                            <p class="event-name"><?php echo $evento['nome_evento']; ?></p>
                        </div>
                        <div class="datetime">
                            <p><?php echo $evento['data_evento']; ?></p>
                        </div>
                    </a>
                </div>
            <?php
                $counter++;
            endforeach;
            ?>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>

</body>
</html>