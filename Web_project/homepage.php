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
   </section>
    <div class="container">

        <?php
        $eventData = getEventInfo($conn, 1); 
        $eventTitle = $eventData['nome_evento'];
        $eventDatatime = $eventData['data_evento'];
        $eventImg = $eventData['url_foto'];
        ?>
        <div class="box">
            <a href="evento.php?eventID=<?php echo $eventData['id_evento']; ?>">
                <div class="image">
                    <img src="<?php echo "$eventImg" ?>" alt="" class="imag">
                </div>
                <div class="title">
                    <p><?php echo "$eventTitle" ?></p>
                </div>
                <div class="datetime">
                <p><?php echo "$eventDatatime"?></p>
                </div>
            </a>
            <div class="image">
                <img src="img/image1.jpg" alt="" class="imag">

            </div>
            <div class="titolo">
                <p>
                    nome uno
                </p>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="img/image2.jpg" alt="" class="imag">
                
                </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="img/image3.jpg" alt="" class="imag">
                
                </div>
        </div>
        <div class="box">
            
            <div class="image">
                <img src="img/image4.jpg" alt="" class="imag">
            </div>
            <div class="info">
                <h3>Nome film</h3>
                <p>infoinfoinfoinfoinfoinfoinfoinfoninfoinfoinfoinfoinfoinfo</p>
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="img/image5.jpg" alt="" class="imag">
                
                </div>

        </div>
        <div class="box">
            <div class="image">
                <img src="img/image6.jpg" alt="" class="imag">
                
            </div>
        
        </div>
        <div class="box">
            <div class="image">
                <img src="img/image7.jpg" alt="" class="imag">
                
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="img/image8.jpg" alt="" class="imag">
                
            </div>

        </div>
        <div class="box">
            <div class="image">
                <img src="img/image9.jpg" alt="" class="imag">

            </div>
                
        </div>
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