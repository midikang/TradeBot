<?php

require_once 'init_db.php';
require_once 'init_table.php';
require_once 'helper_func.php';

createPathDB();

createAccTable();

createPathTable();

createMonitorTable();

echo "done setup_db_translate.php<br>";
?>
