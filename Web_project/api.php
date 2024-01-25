<!-- api.php per gestire le chiamate asincrone RESTful -->

<?php

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);


// connect to the mysql database
$link = mysqli_connect('localhost', 'root', '', 'progettoweb_mobile');
mysqli_set_charset($link,'utf8');

// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$_key = array_shift($request);
$key = $_key;
//$key = $_key + 0;


// escape the columns and values from the input object
if(isset($input)){
  $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
  $values = array_map(function ($value) use ($link) {
    if ($value===null) return null;
    return mysqli_real_escape_string($link,(string)$value);
  },array_values($input));
}


// build the SET part of the SQL command
if(isset($input)){
  $set = '';
  for ($i=0;$i<count($columns);$i++) {
    $set.=($i>0?',':'').'`'.$columns[$i].'`=';
    $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
  }
}
function checkBooking($eventID, $userID) {
  global $link;

  // Verifica se l'utente ha già prenotato per l'evento
  $checkSql = "SELECT * FROM prenotazioni WHERE id_utente_prenotato = $userID AND id_evento_prenotato = $eventID";
  $checkResult = mysqli_query($link, $checkSql);

  if (mysqli_num_rows($checkResult) > 0) {
// L'utente ha già prenotato per questo evento
      echo "Utente già prenotato per questo evento";
      return true;
  } else {
      return false;
  }
}


// create SQL based on HTTP method
switch ($method) {
  case 'GET':
//non lo usiamo
  case 'PUT':
//non lo usiamo
  case 'POST':
//casting di eventID e UID nel caso in cui non siano vuoti (quindi il passaggio è avvenuto correttamente)
        $eventID = isset($input['eventID']) ? (int)$input['eventID'] : 0;
        $userID = isset($input['userID']) ? (int)$input['userID'] : 0;
        if ($eventID > 0 && $userID > 0 && !checkBooking($eventID, $userID)) {
//il passaggio è avvenuto correttamente e l'utente non è già prenotato per quell'evento
//quidni si esegue l'inserimento nella tabella prenotazioni
              $sql = "INSERT INTO prenotazioni (id_evento_prenotato, id_utente_prenotato) VALUES ($eventID, $userID)";
//return perché qualora l'utente dovesse essere già prenotato $sql sarebbe vuoto.
        }else return; 

    break;
  case 'DELETE':
    $sql = "delete from `$table` where id_prenotazione=\"$key\""; break;
}

// excecute SQL statement
$result = mysqli_query($link,$sql);


// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die("Connessione fallita: " . mysqli_connect_error());
}

// print results, insert id or affected row count
if ($method == 'POST' && $table == 'prenotazioni') {
  echo "Prenotazione effettuata con successo!";
}
elseif ($method == 'DELETE') {
    echo "Eliminazione avvenuta con successo";
} else {
  echo "AFFECTED ROWS: " . mysqli_affected_rows($link);
}

// close mysql connection
mysqli_close($link);