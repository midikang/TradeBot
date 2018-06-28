<?php
require_once 'connection.php';

function call_func($cmd){
  switch($cmd){
    case "getPlatforms":
      return getPlatforms();

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
?>
