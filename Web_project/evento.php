<?php
include_once './header.php';
require_once './connection.php';
require_once './includes/functions.inc.php';
$eventID = $_GET["eventID"];
$eventData = getEventInfo($conn, $eventID);
?>

<!DOCTYPE html>

<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $eventData["nome_evento"]; ?></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="evento.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        
    </head>

    <body>

        <!-- Creazione del box inclusi le informazioni dell'evento -->

        <div class="container-evento">
            <div class="box-evento">
                <div id="locandina_evento">
                    <div class="image-container">
                        <img src="<?php echo $eventData["url_foto"]?>">
                    </div>
                </div>
                <div class="info-evento">
                    <div id="titolo_evento">
                        <h1><?php echo $eventData["nome_evento"]; ?></h1>
                    </div>

                    <div id="descrizione_evento">
                        <p><?php echo $eventData["info_evento"]; ?></p>
                    </div>

                    <div id="data_evento">
                        <p><?php echo $eventData["data_evento"]; ?></p>
                    </div>
                    <div class="button">
                            <button id="button-reserve">Prenotati per l'evento</button>
                    </div>
                </div>
            </div>
        </div>
    <script>
    var prenotazioneButton = document.getElementById('button-reserve');

    prenotazioneButton.addEventListener('click', function()
    {if (this.innerHTML === 'Prenotati per l\'evento') {
            this.innerHTML = 'Prenotazione effettuata!';
        }
        else
        {
            this.innerHTML = 'Prenotati per l\'evento';
        }
        });     
    </script>
    </body>
</html>

<?php
include_once './footer.php';
?>
