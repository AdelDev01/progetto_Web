<?php

function emptyInputSignup($username, $email, $pwd, $pwdrepeat){
    $result = null;
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdrepeat)){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function invalidStringInput($string){
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9 '\"._,;:*+\\-<>]*$/", $string)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function fieldMatch($firstField, $secondField){
    $result = null;
    if ($firstField !== $secondField){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username, $email){
    $sql = "SELECT * FROM utenti WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return $row;
    }
    else{
        $resultData = false;
        mysqli_stmt_close($stmt);
        return $resultData;
    }

}

function createUser($conn, $username, $email, $pwd){
    $sql = "INSERT INTO utenti(username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit(); 
    }

    $hashedPwd= password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputCheck($firstField, $secondField){
    $result = null;
    if (empty($firstField) || empty($secondField)){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $userExists = usernameExists($conn, $username, $username);
    //mettere di nuovo $username come 3 parametro garantisce che il controllo nel DB venga effettuato sia sulla mail che sull'username,
    // in modo da poter effettuare l'accesso con uno o con l'altro
    if ($userExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists['password'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../login.php?error=incorrectpassword");
        exit();
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["uid"] = $userExists["uid"];
        $_SESSION["username"] = $userExists["username"];
        header("location: ../homepage.php");
        exit();
    }
}

function reLoginUser($conn, $username, $pwd){
    $userExists = usernameExists($conn, $username, $username);
    //mettere di nuovo $username come 3 parametro garantisce che il controllo nel DB venga effettuato sia sulla mail che sull'username,
    // in modo da poter effettuare l'accesso con uno o con l'altro
    if ($userExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists['password'];
    
    if ($pwdHashed === $pwd){
        session_start();
        $_SESSION["uid"] = $userExists["uid"];
        $_SESSION["username"] = $userExists["username"];
        header("location: ../img/impostazioni.php?error=none");
        exit(); 
    }
    else{
        header("location: ../login.php?error=incorrectpassword");
        exit();
    }
}

// Funzione per ottenere le informazioni dal database

function getUserInfo($conn, $username) {
    // Esegui la query per ottenere le informazioni del campo dal database
    $sql = "SELECT UID, username, password, email, data_creazione_acc FROM utenti WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../homepage.php?error=stmtfailed");
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "s", $username); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Ottieni il risultato della query
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return null;
    }
}

function getEventInfo($conn, int $eventID) {
    // Esegui la query per ottenere le informazioni del campo dal database
    $sql = "SELECT id_evento, nome_evento, data_evento, info_evento, prenotazioni_totali, url_foto FROM evento WHERE id_evento = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../homepage.php?error=stmtfailed");
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "i", $eventID); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Ottieni il risultato della query
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return null;
    }
}

function getEventInfoOrdered($conn, $order = 'ASC') {
    try {
        // ottengo la data attuale per evitare di dare eventi passati
        $currentDate = date('Y-m-d H:i:s');

        // eseguo la query per ottenere gli eventi ordinati per data senza prendere quelli passati
        $sql = "SELECT * FROM evento WHERE data_evento > '$currentDate' ORDER BY data_evento $order";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            throw new Exception("Errore nella query: " . mysqli_error($conn));
        }

        $eventi = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $eventi[] = $row;
        }

        return $eventi;
    } catch (Exception $e) {
        echo "Errore: " . $e->getMessage();
        return array();
    }
}
