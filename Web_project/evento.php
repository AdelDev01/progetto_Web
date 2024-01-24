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
        
        <script>
            window.onload = function(){
                document.getElementById('prenotazione').addEventListener("click", function() {
                    var eventID = <?php echo $eventID; ?>;
                    var userID = <?php echo $_SESSION["UID"]; ?>;                    

                    bookTicket(eventID, userID);
                    
                    if (this.innerHTML === 'Prenotati per l\'evento') {
                        this.innerHTML = 'Prenotazione effettuata!';
                        
                    }
                    else
                    {
                        this.innerHTML = 'Prenotati per l\'evento';
                    }
                });
            }

            function bookTicket(eventID, userID) {
                var oReq = new XMLHttpRequest();
                oReq.onload = function() {
                    document.getElementById("prenotazione").innerHTML = oReq.responseText;
                    document.getElementById("prenotazione").style.marginLeft = "-40px";
                    
                };

                oReq.open("POST", "api.php/prenotazioni/", true);
                oReq.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

                var data = {
                    eventID: eventID,
                    userID: userID
                };

                var jsondata = JSON.stringify(data);
                oReq.send(jsondata);
            }
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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
                    <div class="button"> <!-- Il pulsante non permette la prenotazione qualora non si è prenotati -->
                        <?php if (isset($_SESSION['username'])){ ?>
    
                            <button id="prenotazione">Prenotati per l'evento</button>
                        <?php } 
                        else{ ?>
                            <form action="./login.php">
                                <button id="prenotazione">Accedi per prenotarti!</button>
                            </form> 
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    
    </body>
</html>

<?php
include_once './footer.php';
?>
