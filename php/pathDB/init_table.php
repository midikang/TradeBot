<?php
require_once 'connection.php';
require_once 'helper_func.php';

function createAccTable(){
  echo "createAccTable()<br>";

  $cxn = OpenDBCxn();

  $sql = "drop table if exists accounts
  ;
  create table accounts
  (
    uid varchar(20),
    pw varchar(50),
    primary key (uid)
  )
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating table for accounts<br>$cxn->error");
  }

  $cxn->close();
}

function createPathTable(){
  echo "createPathTable()<br>";

  $cxn = OpenDBCxn();

  $sql = "drop table if exists paths
  ;
  create table paths
  (
    pid int(4) auto_increment,
    json_str varchar(360) not null,
    primary key (pid)
  )
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating table for path<br>$cxn->error");
  }

  $cxn->close();
}

function createCrossPlatTable(){
  echo "createCrossPlatTable()<br>";

  $cxn = OpenDBCxn();

  $sql = "drop table if exists crossPlats
  ;
  create table crossPlats
  (
    pid int(4) not null,
    plat1 varchar(20) not null,
    plat2 varchar(20) not null,
    foreign key (pid) references paths(pid)
  )
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating table for cross plat path<br>$cxn->error");
  }

  $cxn->close();
}

function createMonitorTable(){
  echo "createMonitorTable()<br>";

  $cxn = OpenDBCxn();

  $sql = "drop table if exists monitors
  ;
  create table monitors
  (
    uid varchar(20),
    pid int(4),
    rate int(5) not null,
    primary key (uid,pid),
    foreign key (pid) references paths(pid),
    foreign key (uid) references accounts(uid) on delete cascade
  )
  ";

  if (mysqli_multi_query($cxn,$sql)){
    freeMultiQueryNoResult($cxn);
  } else {
    die("error creating table for user and path<br>$platform<br>$cxn->error");
  }

  $cxn->close();
}



?>
