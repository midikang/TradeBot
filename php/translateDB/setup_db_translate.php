<?php

require_once 'init_db.php';
require_once 'init_table.php';
require_once 'helper_func.php';

createTranslateDB();

$prefix = '../../htdocs/tradebot/php/translateDB'; # this is an ad-hoc for using XAMPP
createPlatformsTable();
importCSVintoTable("$prefix/resources/platforms.csv","platforms");

createInt2NameDict();
importCSVintoTable("$prefix/resources/int2name.csv","int2name");

$plats = getPlatforms();

foreach ($plats as $platform)
{
  createAlias2NameDict($platform);
  importCSVintoTable("$prefix/resources/$platform.csv",$platform);
}

echo "done setup_db_translate.php<br>";
?>
