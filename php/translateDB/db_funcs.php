<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "getPlatforms":
      return getPlatforms();

    case "getInt2Name":
      return getInt2Name();

    default:
        die("unrecognized translate command:       $cmd");
  }
}

function getPlatforms()
{
  #echo "getting all platforms<br>";

  $cxn = openDBCxn();

  $sql = "select platform from platforms";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tgetPlatforms()\n$cxn->error");
  }

  $platforms = array();
  if ($result->num_rows > 0) {
    $index = 0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $platforms[$index] = $row['platform'];

        $index += 1;
    }

  }
  $cxn->close();
  return $platforms;
}

function getInt2Name()
{
  $cxn = openDBCxn();

  $sql = "select int_repr, coin_name from int2name";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tgetInt2Name()\n$cxn->error");
  }

  $int2name = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $int2name[$row['int_repr']] = $row['coin_name'];
    }
  }
  $cxn->close();
  return $int2name;
}
?>
