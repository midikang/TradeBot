<?php
require_once 'connection.php';
require_once 'helper_func.php';

function createTranslateDB(){
  echo "createTranslateDB()<br>";

  $cxn = OpenServerCxn();

  $sql = "drop database if exists translate
  ;
  create database translate
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);

    $cxn->close();
  } else {
    die("error creating the database<br>$cxn->error");
  }
}
?>
