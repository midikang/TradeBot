<?php
  require_once("translateDB/look_up_functions.php");

  echo json_encode(call_func($_GET['cmd']));
?>
