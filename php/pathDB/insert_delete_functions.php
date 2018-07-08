<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "isValidUser":
      return isValidUser($_POST['uid'],$_POST['pw']);

    case "uidExists":
      return uidExists($_POST['uid']);

    case "insertMonitor":
      return insertMonitor($_POST['uid'],$_POST['pw'],$_POST['pid'],$_POST['rate']);

    case "deleteMonitor":
      return deletePath($_POST['uid'],$_POST['PW'],$_POST['pid']);

    case "insertUser":
      return insertUser($_POST['uid'], $_POST['pw']);

    case "deleteUser":
      return deleteUser($_POST['uid'], $_POST['pw']);

    case "insertPath":
      return insertPath($_GET['plat1'],$_GET['plat2'],$_GET['path_jsonStr']);

    case "deletePath":
      return deletePath($_GET['pid']);

    default:
        die("unrecognized path command:       $cmd");
  }
}

function executeDelete($table, $condition){
  $cxn = OpenDBCxn();

  $sql = "delete from $table where $condition";

  $result = $cxn->query($sql);

  if (!$result){
    echo "<br>deleting from $table wasn't successful<br>\n$cxn->error";
  }

  $cxn->close();
}

function executeInsert($table, $bracket_cskey, $bracket_csval){
  $cxn = OpenDBCxn();

  $sql = "insert into $table $bracket_cskey values $bracket_csval";

  #echo $sql;

  $result = $cxn->query($sql);

  if (!$result){
    echo "<br>inserting into $table wasn't successful<br>\n$cxn->error";
  }

  $cxn->close();
}

function isValidUid($u){
  return preg_match("/[a-zA-Z](\w{3,14})/", $u); //allows 4-15 characters uid
}

function isValidUser($u,$p){
  if (isValidUid($u)) {
    $cxn = OpenDBCxn();

    $sql = "select uid from accounts where uid = '$u' and pw = '$p'";

    $result = $cxn->query($sql);

    if (!$result){
      die("sql result error in\t\tisValidUser()\n$cxn->error");
    }
    echo "$u<br>$p";
    if ($result->num_rows == 1) { # there exists unique user
      echo "1 result";
      return ($result->fetch_assoc())["uid"] == $u;
    }
  }
  echo "bad";
  return false;
}

function insertUser($uid, $pw){
  if (isValidUid($uid)) {
    executeInsert("accounts", "(uid,pw)","('$uid','$pw')");
  } else {
    die("unverified usage of insertMonitor()");
  }
}

function insertMonitor($uid, $pw, $pid,$rate){
  if(isValidUser($uid,$pw)){
    executeInsert("monitors", "(uid,pid,rate)","('$uid',$pid,$rate)");
  } else {
    die("unverified usage of insertMonitor()");
  }
}

function insertPath($plat1,$plat2,$path_jsonStr){
  executeInsert("paths", "(plat1,plat2,jsons)","('$plat1','$plat2','$path_jsonStr')");
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
    die("unverified usage of deleteMonitor()");
  }
}

function deletePath($pid){
  executeDelete("paths", "pid=$pid");
}


#echo getIntWithAlias("yobit","btc"); // 33 regardless of platform
?>
