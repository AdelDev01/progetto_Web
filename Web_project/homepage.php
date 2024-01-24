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
    <title>TicketSell</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kufam:ital,wght@1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <script src="./errors.js"></script>
    
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
            <div class="highlight-images">
                <a href=""><img src="img/image1.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image2.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image3.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image4.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image5.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image6.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image7.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image8.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image9.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image1.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image2.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image3.jpg" alt="" class="imag"></a>

            </div>
            <div class="highlight-images">
                <a href=""><img src="img/image4.jpg" alt="" class="imag"></a>

            </div>
    </section>
   </div>
   <div class="divisor">
   </div>
   <div class="event-title-dashboard">
        <p>DI TENDENZA IN QUESTO MOMENTO</p>
   </div>

   <!-- Ogni box equivale a un evento -->

   <div class="container">
    
        <?php //ottengo l'ordine degli eventi dal DB

        $eventi = getEventInfoOrdered($conn, 'ASC');
        foreach ($eventi as $evento) : ?>
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
        <?php endforeach; ?>
    </div>

    <?php require_once 'footer.php'; ?>

</body>
</html>