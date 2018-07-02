<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "selectPath":
      return selectPath($_GET['uid']);

    case "insertMonitor":
      return insertPath($_GET['uid'],$_GET['pid']);

    case "deleteMonitor":
      return deletePath($_GET['uid'],$_GET['pid']);

    case "insertUser":
      return insertUser($_GET['uid'], $_GET['pw']);

    case "deleteUser":
      return deleteUser($_GET['uid'], $_GET['pw']);

    case "insertPath":
      return insertPath($_GET['path_jsonStr']);

    case "deletePath":
      return deletePath($_GET['pid']);

    default:
        die("unrecognized path command:       $cmd");
  }
}

function executePPstmt($ppstmt){

}

function executeDelete($table, $condition){
  $cxn = OpenDBCxn();

  $sql = "delete from $table where $condition";

  #echo "<br>$sql<br>";

  # TODO use prepared statements
  # executePPstmt($ppstmt);

  $result = $cxn->query($sql);

  if (!$result){
    echo "<br>deleting from $table wasn't successful<br>";
  }

  $cxn->close();
}

function executeInsert($table, $bracket_cskey, $bracket_csval){
  $cxn = OpenDBCxn();

  $sql = "insert into $table $bracket_cskey values $bracket_csv";

  $result = $cxn->query($sql);

  if (!$result){
    echo "<br>inserting into $table wasn't successful<br>";
  }

  $cxn->close();
}

function insertUser($uid, $pw){
  executeInsert("accounts", "(uid,pw)","($uid,$pw)");
}

function insertMonitor($uid, $pid){
  executeInsert("accounts", "(uid,pw)","($uid,$pw)");
}

function insertPath($path_jsonStr){
  executeInsert("paths", "(json_str)",$path_jsonStr);
}

function deleteUser($uid, $pw){
  if(isValidUser($uid,$pw)){
    executeDelete("accounts", "uid='$uid' and pw='$pw'");
  } else {
    die("unverified usage of deleteUser()");
  }
}

function deleteMonitor($uid, $pw, $pid){
  if(isValidUser($uid,$pw)){
    executeDelete("monitors", "uid='$uid' and pid=$pid");
  } else {
    die("unverified usage of deleteUser()");
  }
}

function deletePath($pid){
  executeDelete("paths", "pid=$pid");
}


#echo getIntWithAlias("yobit","btc"); // 33 regardless of platform
?>
