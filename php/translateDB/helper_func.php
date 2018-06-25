<?php
require_once 'connection.php';

function importCSVintoTable($infile,$table_name)
{
  echo "import $infile into translate.$table_name<br>";
  $cxn = openDBCxn($GLOBALS["dbname"]);

  $sql = "load data infile '$infile' into table $table_name
  fields terminated by ','
  lines terminated by '\n'";

  if ($cxn->query($sql)){
    $cxn->close();
  } else {
    die("importing failed<br>$cxn->error");
  }
}

function getPlatforms()
{
  echo "getting all platforms<br>";

  $cxn = openDBCxn($GLOBALS["dbname"]);

  $sql = "select platform from platforms";

  $result = $cxn->query($sql);

  $index = 0;
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $platforms[$index] = $row['platform'];

        $index += 1;
    }

    $cxn->close();
    return $platforms;

  } else {
    echo "0 rows of results";
  }
  $cxn->close();
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
