// funzione per aprire il popup con il messaggio di errore
function openDialog() {
    var myDialog = document.getElementById('myDialog');
    myDialog.showModal();
}

//funzione per chiudere il popip
function closeDialog() {
    var myDialog = document.getElementById('myDialog');
    myDialog.close();
}

function bookTicket(eventID, userID) {
    var oReq = new XMLHttpRequest();
    oReq.onload = function() {
        document.getElementById("prenotazione").innerHTML = oReq.responseText;
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

function eliminaPrenotazione(idPrenotazione) {
    console.log("BALOTELLI")
    // richiesta AJAX per eliminare la prenotazione
    var oReq = new XMLHttpRequest();
    oReq.onload = function() {
        // Ricarica la pagina una volta eliminata la prenotazxione
        location.reload();
    };

    oReq.open("DELETE", "api.php/prenotazioni/" + idPrenotazione, true);
    oReq.send();
}
