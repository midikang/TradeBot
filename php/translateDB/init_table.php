<?php
require_once 'connection.php';
require_once 'helper_func.php';

function createPlatformsTable(){
  echo "createPlatformsTable()<br>";

  $cxn = OpenDBCxn("translate");

  $sql = "drop table if exists platforms
  ;
  create table platforms
  (
    platform varchar(20),
    primary key (platform)
  )
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating table for platforms<br>$cxn->error");
  }

  $cxn->close();
}

function createInt2NameDict(){
  echo "createInt2NameDict()<br>";

  $cxn = OpenDBCxn("translate");

  $sql = "drop table if exists int2name
  ;
  create table int2name
  (
    int_repr int(3) unique not null,
    coin_name varchar(25),
    primary key (coin_name)
  )
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating int2name<br>$cxn->error");
  }

  $cxn->close();
}

function createAlias2NameDict($platform){
  echo "createAlias2NameDict()<br>";

  $cxn = OpenDBCxn("translate");

  $sql = "drop table if exists $platform
  ;
  create table $platform
  (
    coin_alias varchar(10) unique not null,
    coin_name varchar(25),
    primary key (coin_name)
  )
  ";

  #$sql = "drop table if exists bitfinex;  create table bitfinex(coin_name varchar(15),coin_alias varchar(10) unique not null,primary key (coin_name))";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating dict for platform<br>$platform<br>$cxn->error");
  }

  $cxn->close();
}



?>
