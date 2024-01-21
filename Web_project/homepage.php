<?php 
require_once './connection.php'; 
require_once './includes/functions.inc.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketSell</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require_once 'header.php'; ?>

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
   <div class="divisor">
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
                        <p><?php echo $evento['nome_evento']; ?></p>
                    </div>
                    <div class="datetime">
                        <p><?php echo $evento['data_evento']; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
        if (isset($_GET['error'])) {
            if($_GET['error'] == 'notlogged'){
                echo "<p>Non hai effettuato l'accesso!</p>";
            }
            if($_GET['error'] == 'alreadylogged'){
                echo "<p>Hai già effettuato l'accesso!</p>";
            }
        }

    require_once 'footer.php'; ?>

</body>
</html>