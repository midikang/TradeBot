<?php
require_once 'connection.php';

function executeSelect($select_field, $select_table, $cond_field, $cond_value){
  $cxn = OpenDBCxn();

  $sql = "select $select_field from $select_table where $cond_field = '$cond_value'";
  #$sql = "select int_repr from int2name where coin_name = 'bitcoin'";

  #echo $sql;

  $result = $cxn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        return $row[$select_field];
    }
  } else {
    echo "0 rows of results";
    return;
  }

  $cxn->close();
}

function getIntWithName($name){
  return executeSelect("int_repr", "int2name", "coin_name", $name);
}

echo $GLOBALS["dbname"]."<br>";
echo "lala:".getIntWithName("bitcoin");

function getIntWithAlias($platform, $alias){
  return executeSelect("int_repr", $platform, "coin_alias", $alias);
}

function getNameWithInt(){

}

function getNameWithAlias(){

}

function getAliasWithName(){

}

function getAliasWithInt(){

}


?>
