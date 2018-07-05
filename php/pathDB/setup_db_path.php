<?php

require_once 'init_db.php';
require_once 'init_table.php';

createPathDB();

createAccTable();

createPathTable();

createMonitorTable();

echo "done setup_db_path.php<br>";
?>
