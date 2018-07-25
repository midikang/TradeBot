<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "getPlatforms":
      return getPlatforms();

    case "getInt2Name":
      return getInt2Name();

    case "getFullDictionary":
      return getFullDictionary();

    case "getInt2Alias":
      return getInt2Alias($_GET['platform']);

    case "getAlias2Int":
      return getAlias2Int($_GET['platform']);

    default:
        die("unrecognized translate command:       $cmd");
  }
}

function getAllDictionary(){
  $plats = getPlatforms();

  $cxn = openDBCxn();

  $sql = "select int_repr, int2name.coin_name";
  foreach ($plats as $plat){
    $sql.= ", $plat.coin_alias as $plat";
  }

  $sql.=  " from int2name";

  foreach ($plats as $plat){
    $sql.= " left join $plat on $plat.coin_name = int2name.coin_name";
  }

  /*echo $sql."<br><br>"; // */

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tgetAllDictionaries()\n$cxn->error");
  }

  $dictionaries = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //$dictionaries[$row['int_repr']] = array();
        foreach ($plats as $plat){
          $dictionaries[$row['int_repr']][$plat] = $row["$plat"];
        }
    }
  }
  $cxn->close();


  return $dictionaries;
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

function getInt2Alias($plat)
{
  $cxn = openDBCxn();

  $sql = "select int_repr, coin_alias from $plat natural join int2name";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tgetInt2Alias($plat)\n$cxn->error");
  }

  $int2alias = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $int2alias[$row['int_repr']] = $row['coin_alias'];
    }
  }
  $cxn->close();
  return $int2alias;
}

function getAlias2Int($plat)
{
  $cxn = openDBCxn();

  $sql = "select int_repr, coin_alias from $plat natural join int2name";

  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\tgetAlias2Int($plat)\n$cxn->error");
  }

  $alias2int = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $alias2int[$row['coin_alias']] = $row['int_repr'];
    }
  }
  $cxn->close();
  return $alias2int;
}
?>
