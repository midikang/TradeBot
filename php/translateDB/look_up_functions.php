<?php
require_once 'connection.php';

function executeSelect($select_field, $select_table, $cond_field, $cond_value){
  $cxn = OpenCon();

  $sql = "select ".$select_field." from ".$select_table." where ".$cond_field." = '".$cond_value."'";
  #$sql = "select int_repr from int2name where coin_name = 'bitcoin'";

  #echo $sql;

  $result = $cxn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> ".$row[$select_field]." <br>";
    }
  } else {
    echo "0 rows of results";
  }

  $cxn->close();
}

function getIntWithName($name){
  executeSelect("int_repr", "int2name", "coin_name", $name);
}


echo "lala:".getIntWithName("bitcoin");

function getIntWithAlias(){
  $conn = OpenCon();

  $conn->close();
}

function getNameWithInt(){
  $conn = OpenCon();

  $conn->close();
}

function getNameWithAlias(){
  $conn = OpenCon();

  $conn->close();
}

function getAliasWithName(){
  $conn = OpenCon();

  $conn->close();
}

function getAliasWithInt(){
  $conn = OpenCon();

  $conn->close();
}


?>
