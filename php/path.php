<?php
  require_once("pathDB/insert_delete_functions.php");

  echo json_encode(call_func($_GET['cmd']));
?>
