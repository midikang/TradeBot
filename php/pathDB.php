<?php
require_once("pathDB/db_funcs.php");
echo json_encode(call_func($_GET['cmd']));
?>
