<?php
require_once 'connection.php';

function importCSVintoTable($infile,$table_name)
{
  echo "import $infile into translate.$table_name<br>";
  $cxn = openDBCxn();

  $sql = "load data infile '$infile' into table $table_name
  fields terminated by ','";

  if ($cxn->query($sql)){
    $cxn->close();
  } else {
    die("importing failed<br>$cxn->error");
  }
}

function freeMultiQueryNoResult($cxn)
{
  do{
      if ($result = mysqli_store_result($cxn)){
        mysqli_free_result($result);
      }
  } while (mysqli_next_result($cxn));
}
#print_r(getPlatforms());

?>
