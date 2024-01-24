<?php 
    session_start();
    include_once './header.php';
    if (!isset($_SESSION['username'])){
        header("location: ./homepage.php?error=notlogged");
        exit();
    }

    require_once 'connection.php';
    require_once './includes/functions.inc.php';

    // Query per ottenere le informazioni personali
    $user = getUserInfo($conn, $_SESSION['username']);
    $username = $user["username"];
    $email = $user["email"];
    $data_creaz = $user["data_creazione_acc"];
    $uid = $user["UID"];

    //query per ottenere gli eventi a cui si è prenotati
    $bookedEvents = getUserBookings($conn, $uid);


?>


<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profilo - <?php echo $username ; ?></title>
        <link rel="stylesheet" type="text/css" href="./style.css">
        <link rel="stylesheet" type="text/css" href="login-signup-profile.css">
        <script src="https://kit.fontawesome.com/073667f4ba.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>
    <?php include_once './header.php'; ?>
        <div class="container-profilo">
            <div class="box">
                <i class="fa-solid fa-id-card"></i>
                <h1 id="titolo-profilo">Benvenuto nel tuo profilo <?php echo $username ; ?></h1>
                <br>
                <div class="informazioni_utente">
                        <h4>Le tue informazioni:</h4>
                    <div id="dati_utente">
                        <p id="e-mail">ID utente: <?php echo $uid ; ?> </p>
                        <p id="nome-utente">Nome utente: <?php echo $username ; ?> </p>
                        <p id="e-mail">Email: <?php echo $email ; ?> </p>
                        <p id="data-creazione-account">Data creazione dell'account: <?php echo $data_creaz ; ?> </p>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="eventi_utente">
            <h1 class="event-title-dashboard">I tuoi eventi</h1>
            <div class="container">
                <div class="box-container">
                    <?php
                    // Verifica se ci sono eventi prenotati
                    if (!empty($bookedEvents)) {
                        foreach ($bookedEvents as $booking) {
                            // Chiamata alla funzione per ottenere informazioni sull'evento
                            $eventInfo = getEventInfo($conn, $booking['id_evento_prenotato']);
                            
                            echo '<div class="box">';
                                echo "<a href='evento.php?eventID=" . $eventInfo['id_evento'] . "'>";
                                    echo '<div class="image">';
                                        echo '<img src="' . $eventInfo['url_foto'] . '" alt="" class="imag">';
                                    echo '</div>';
                                    echo '<div class="title">';
                                        echo '<p class="event-name">' . $eventInfo['nome_evento'] . '</p>';
                                    echo '</div>';
                                    echo '<div class="datetime">';
                                        echo '<p>' . $eventInfo['data_evento'] . '</p>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';

                        }
                    } else {
                        // Nessun evento prenotato, mostra un messaggio
                        echo '<div>Nessun evento prenotato.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>


    <?php include_once './footer.php'; ?>

    </body>
</html>