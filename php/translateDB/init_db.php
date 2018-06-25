<?php
require_once 'connection.php';
require_once 'helper_func.php';

function createTranslateDB($dbname){
  echo "createTranslateDB()<br>";

  $cxn = OpenServerCxn();

  $sql = "drop database if exists $dbname
  ;
  create database $dbname
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);

    $GLOBALS['dbname'] = $dbname;

    $cxn->close();
  } else {
    die("error creating the database: $dbname<br>$cxn->error");
  }
}
?>
