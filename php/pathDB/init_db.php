<?php
require_once 'connection.php';
require_once 'helper_func.php';

function createPathDB(){
  echo "createPathDB()<br>";

  $cxn = OpenServerCxn();

  $sql = "drop database if exists path
  ;
  create database path
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);

    $cxn->close();
  } else {
    die("error creating the database: translate<br>$cxn->error");
  }
}
?>
