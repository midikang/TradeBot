<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "isValidUser":
      return isValidUser($_GET['uid'],$_GET['pw']);

    case "selectMonitors":
      return selectMonitors($_GET['uid'],$_GET['pw']);

    case "selectPaths":
      return selectPaths($_GET['from'],$_GET['to']);

    default:
        die("unrecognized path command:       $cmd");
  }
}

function isValidUser($u,$p){
  $cxn = OpenDBCxn();

  $sql = "select uid from accounts where uid = '$u' and pw = '$p'";

  if ($result and $result->num_rows > 0) { # there exists such user
    return true;
  }

  return false;
}


function selectMonitors($uid,$pw){
  $cxn = OpenDBCxn();

  $sql = "select m.pid, json_str, rate
  from accounts as a natural join monitors as m
    natural join paths
  where a.uid = '$uid' and a.pw = '$pw'
  ";

  #echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  $monitors = array();
  if ($result and $result->num_rows > 0) {
    // output data of each row
    while($monitor = $result->fetch_assoc()) {
        array_push($monitors,$monitor);
    }
  }

  $cxn->close();

  return $monitors;
}

function selectPaths($from, $to){
  $cxn = OpenDBCxn();

  $sql = "select pid, json_str
  from crossPlats natural join paths
  where from = '$from' and to = '$to'
  ";

  #echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  $paths = array();
  if ($result and $result->num_rows > 0) {
    // output data of each row
    while($path = $result->fetch_assoc()) {
        array_push($paths,$path);
    }
  }

  $cxn->close();

  return $paths;
}
?>
