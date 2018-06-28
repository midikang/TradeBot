<?php
require_once 'connection.php';

function isValidUser($u,$p){
  $cxn = OpenDBCxn();

  $sql = "select uid from accounts where uid = '$u' and pw = '$p'";

  if ($result and $result->num_rows > 0) { # there exists such user
    return true;
  }

  return false;
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
?>
