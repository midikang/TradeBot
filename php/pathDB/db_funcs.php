<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "getMostRecentPid":
      return getMostRecentPid();

    case "selectMonitors":
      return selectMonitors($_GET['uid'],$_GET['pw']);

    case "selectPaths":
      return selectPaths($_GET['plat1'],$_GET['plat2']);

    default:
        die("unrecognized path command:       $cmd");
  }
}

function getMostRecentPid(){
  $cxn = OpenDBCxn();

  $sql = "select max(pid) as recentPid from paths";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tisValidUser()\n$cxn->error");
  }

  $row = $result->fetch_assoc();
  if ($row['recentPid']) {
    return (int)$row['recentPid'];
  }

  return 0; # there exists no result
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

  if (!$result){
    die("sql result error in\t\tselectMonitors()\n$cxn->error");
  }

  $monitors = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($monitor = $result->fetch_assoc()) {
        array_push($monitors,$monitor);
    }
  }

  $cxn->close();

  return $monitors;
}

function selectPaths($plat1, $plat2){
  $cxn = OpenDBCxn();

  $sql = "select pid, json_str
  from crossPlats natural join paths
  where plat1 = '$plat1' and plat2 = '$plat2'
  ";

  #echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tselectPaths()");
  }

  $paths = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($path = $result->fetch_assoc()) {
        array_push($paths,$path);
    }
  }

  $cxn->close();

  return $paths;
}
?>
