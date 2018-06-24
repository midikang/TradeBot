<?php
include 'login_info.php';

function OpenDBCxn($dbname)
 {
 $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $dbname);

 if ($conn->connect_error){
   die("Connect to db $dbname failed: <br>$conn->connect_error");
 }

 //echo "successfully connected to localhost's MySQL";

 return $conn;
 }

function OpenServerCxn()
{
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password']);

if ($conn->connect_error){
  die("Connect to server $servername failed: <br>$conn->connect_error");
}

//echo "successfully connected to localhost's MySQL";

return $conn;
}

?>
