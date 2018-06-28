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

function executeDelete($table, $condition){
  $cxn = OpenDBCxn();

  $sql = "delete from $table where $condition";

  #echo "<br>$sql<br>";

  # TODO use prepared statements
  # executePPstmt($ppstmt);

  $result = $cxn->query($sql);

  $cxn->close();
}

function executePPstmt($ppstmt){

}

function getResultsArr($select_field, $result){

}

function selectPath($uid){
  $cxn = OpenDBCxn();

  $sql = "select platform,head,tail,symbol,is_inverted
  from monitors natural join paths
  where uid = '$uid'
  order by index asce";

  #echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  $path_TP = array();
  if ($result and $result->num_rows > 0) {
    // output data of each row
    while($tradePair = $result->fetch_assoc()) {
        array_push($path_TP,$tradePair);
    }
  }

  $cxn->close();

  return $path_TP;
}

function insertUser($uid){
  return executeSelect("int_repr", "int2name", "coin_name = '$name'", true);
}

function insertMonitor($uid, $pid){
  return executeSelect("coin_name", "int2name", "int_repr = '$int'", true);
}

function insertPath($path_jsonStr){
  return executeSelect("coin_name", $platform, "coin_alias = '$alias'", true);
}

function getAliasWithName($platform, $name){
  return executeSelect("coin_alias", $platform, "coin_name = '$name'", true);
}

function getIntWithAlias($platform, $alias){
  return getIntWithName(getNameWithAlias($platform,$alias));
}

function getAliasWithInt($platform, $int){
  return getAliasWithName($platform,getNameWithInt($int));
}

#echo getIntWithAlias("yobit","btc"); // 33 regardless of platform
?>
