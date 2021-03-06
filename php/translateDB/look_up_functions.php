<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "getAliases":
      return getAliases($_GET['platform']);

    case "getIntWithName":
      return getIntWithName($_GET['name']);

    case "getNameWithInt":
      return getNameWithInt($_GET['int']);

    case "getNameWithAlias":
      return getNameWithAlias($_GET['platform'], $_GET['alias']);

    case "getAliasWithName":
      return getAliasWithName($_GET['platform'], $_GET['name']);

    case "getIntWithAlias":
      return getIntWithAlias($_GET['platform'], $_GET['alias']);

    case "getAliasWithInt":
      return getAliasWithInt($_GET['platform'], $_GET['int']);

    default:
        die("unrecognized translate command:       $cmd");
  }
}

function executeSelect($select_field, $select_table, $condition, $selectOne){
  $cxn = OpenDBCxn();

  $sql = "select $select_field from $select_table where $condition";
  #$sql = "select coin_name from int2name where coin_name = 'bitcoin'";

  #echo "<br>$sql<br>";
  $result = $cxn->query($sql);

  if (!$result){
    die("sql result error in\t\texecuteSelect()\n$cxn->error");
  }

  $cxn->close();
  if ($selectOne){
    return getResult($select_field, $result);
  } else {
    return getResultsArr($select_field, $result);
  }

}

function getResult($select_field, $result){
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        return $row[$select_field];
    }

  } else { // return default values
    if ($select_field == "int_repr"){
      return 0;
    }
    if ($select_field == "coin_name"){
      return "name";
    }
    if ($select_field == "coin_alias"){
      return "alias";
    }
  }
}

function getResultsArr($select_field, $result){
  $retArr = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($retArr,$row[$select_field]);
    }
  }
  return $retArr;
}

function getAliases($platform){
  return executeSelect("coin_alias", $platform, "coin_name <> 'name'", false);
}

function getIntWithName($name){
  return executeSelect("int_repr", "int2name", "coin_name = '$name'", true);
}

function getNameWithInt($int){
  return executeSelect("coin_name", "int2name", "int_repr = '$int'", true);
}

function getNameWithAlias($platform, $alias){
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
