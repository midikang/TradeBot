<?php
require_once("translateDB/db_funcs.php");
echo json_encode(call_func($_GET['cmd']));
?>
