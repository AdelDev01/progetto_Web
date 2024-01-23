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

// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "select UID, username, email, data_creazione_acc from `$table`".($key?" WHERE username=\"$key\"":''); break;
  case 'PUT':
    $sql = "update `$table` set $set where email=\"$key\""; break;
  case 'POST':
    $sql = "insert into `$table` set $set"; break;
  case 'DELETE':
    $sql = "delete from `$table` where email=\"$key\""; break;
}

// excecute SQL statement
$result = mysqli_query($link,$sql);


// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die("Connessione fallita: " . mysqli_connect_error());
}

// print results, insert id or affected row count
if ($method == 'GET') {
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  //echo "INSERT ID: " . mysqli_insert_id($link);
  echo "INSERT OK";
} else {
  echo "AFFECTED ROWS: " . mysqli_affected_rows($link);
}

// close mysql connection
mysqli_close($link);
