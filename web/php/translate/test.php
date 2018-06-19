<?php
include 'db_connection.php';

function executeSQL($ppStmt){
  if ($ppStmt->execute() === FALSE) {
      die( "executing prepared Stmt failed: ".htmlspecialchars($ppStmt->error) );
  }
  if ($ppStmt->bind_result($ret) === FALSE) {
      die( "binding result failed: ".htmlspecialchars($ppStmt->error) );
  }

  echo "\npassed\n";
  while ($ppStmt->fetch()) {
    echo "fetching result in while loop<br>";
    echo "return value is: ".$ret;
  }
  return $ret;
}

function getIntWithName($name){
  $conn = OpenCon();

  $sql = "select int_repr from int2name where coin_name = 'bitcoin'";

  $ppStmt = $conn->prepare($sql);
  if ($ppStmt === FALSE) {
      die( "preparing Stmt failed: ".htmlspecialchars($conn->error) );
  }

  //$ppStmt->bind_param("s",$name);

  if ($ppStmt->execute() === FALSE) {
      die( "executing prepared Stmt failed: ".htmlspecialchars($ppStmt->error) );
  }
  if ($ppStmt->bind_result($ret) === FALSE) {
      die( "binding result failed: ".htmlspecialchars($ppStmt->error) );
  }

  echo "\npassed\n";
  while ($ppStmt->fetch()) {
    echo "fetching result in while loop<br>";
    echo "return value is: ".$ret;
  }
  
  $ppStmt->close();
  $conn->close();
  return $ret;

}
echo "allalalaa";
echo "".getIntWithName("bitcoin");

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
