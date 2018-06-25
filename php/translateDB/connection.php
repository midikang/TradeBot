<?php
require_once 'login_info.php';

function OpenDBCxn()
{
  $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], "translate");

  if ($conn->connect_error){
   die("Connect to db <br>translate<br> failed: <br>$conn->connect_error");
  }

  return $conn;
}


function OpenServerCxn()
{
  $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password']);

  if ($conn->connect_error){
    die("Connect to server ".$GLOBALS['servername']." failed: <br>$conn->connect_error");
  }

  return $conn;
}

?>
