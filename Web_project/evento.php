<?php
include_once './header.php';
require_once './connection.php';
require_once './includes/functions.inc.php';
$eventID = $_GET["eventID"];
session_start();
$eventData = getEventInfo($conn, $eventID);
?>

<!DOCTYPE html>
<html lang="it">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $eventData["nome_evento"]; ?></title>
        <link rel="stylesheet" href="./style.css">
        
    </head>

    <body>
        <div id="titolo_evento">
            <h1><?php echo $eventData["nome_evento"]; ?></h1>
        </div>

        <div id="descrizione_evento">
            <p><?php echo $eventData["info_evento"]; ?></p>
        </div>

        <div id="data_evento">
            <p><?php echo $eventData["data_evento"]; ?></p>
        </div>

        <div id="locandina_evento">
            <img src="<?php echo $eventData["url_foto"]?>">
        </div>
            
    </body>
</html>

<?php
include_once './footer.php';
?>
