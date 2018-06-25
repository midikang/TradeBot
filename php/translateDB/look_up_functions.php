<?php
require_once 'connection.php';

function executeSelect($select_field, $select_table, $cond_field, $cond_value){
  $cxn = OpenDBCxn();

  $sql = "select $select_field from $select_table where $cond_field = '$cond_value'";
  #$sql = "select coin_name from int2name where coin_name = 'bitcoin'";

  echo "<br>$sql<br>";

  $result = $cxn->query($sql);

  if ($result and $result->num_rows > 0) {
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

  $cxn->close();
}

function getIntWithName($name){
  return executeSelect("int_repr", "int2name", "coin_name", $name);
}

function getNameWithInt($int){
  return executeSelect("coin_name", "int2name", "int_repr", $int);
}

function getNameWithAlias($platform, $alias){
  return executeSelect("coin_name", $platform, "coin_alias", $alias);
}

function getAliasWithName($platform, $name){
  return executeSelect("coin_alias", $platform, "coin_name", $name);
}

function getIntWithAlias($platform, $alias){
  return getIntWithName(getNameWithAlias($platform,$alias));
}

function getAliasWithInt($platform, $int){
  return getAliasWithName($platform,getNameWithInt($int));
}

// echo getIntWithAlias("bitfinex","btc"); // 33
?>
