<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "selectMonitors":
      return selectMonitors($_POST['uid']);

    case "selectUsers":
      return selectUsers();

    case "selectCrossPlatPaths":
      return selectCrossPlatPaths($_GET['plat1'],$_GET['plat2']);

    case "selectAllPaths":
      return selectAllPaths();

    default:
        die("unrecognized path command:       $cmd");
  }
}

function selectUsers(){
  $cxn = OpenDBCxn();

  $sql = "select uid from accounts
  ";

  #echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tselectUsers()\n$cxn->error");
  }

  $users = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($user = $result->fetch_assoc()) {
        array_push($users,$user);
    }
  }

  $cxn->close();

  return $users;
}

function selectMonitors($uid){
  $cxn = OpenDBCxn();

  $sql = "select m.pid, plat1,plat2,jsons, rate
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

function selectCrossPlatPaths($plat1,$plat2){
  return selectPaths("plat1 = '$plat1' and plat2 = '$plat2'");
}

function selectAllPaths(){
  return selectPaths("1=1");
}

function selectPaths($condition){
  $cxn = OpenDBCxn();

  $sql = "select pid,plat1,plat2,jsons from paths
  where $condition
  ";

  #echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tselectPaths()\n$cxn->error");
  }

  $retArr = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      // each row is
      // { "plat1":"str","plat2":"str","json_str":"x","pid":int }
      // "x" is a json_encoded string of the object: [json,json,json,...]
        array_push($retArr,$row);
    }
  }

  $cxn->close();

  return $retArr;
}
?>
