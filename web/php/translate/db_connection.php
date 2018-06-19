<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "password";
 $dbname = "translate";


 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

 if ($conn->connect_error){
   die("Connect failed: %s\n". $conn -> connect_error);
 }

 //echo "successfully connected to localhost's MySQL";

 return $conn;
 }

?>
