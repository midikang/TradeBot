<?php

require_once 'init_db.php';
require_once 'init_table.php';
require_once 'helper_func.php';

createTranslateDB();

createPlatformsTable(); # table is named platforms
importCSVintoTable("../../htdocs/tradebot/web/php/translate/coins/platforms.csv","platforms");

createInt2NameDict();
importCSVintoTable("../../htdocs/tradebot/web/php/translate/coins/int2name.csv","int2name");

$plats = getPlatforms();

foreach ($plats as $platform)
{
  createAlias2NameDict($platform);
  importCSVintoTable("../../htdocs/tradebot/web/php/translate/coins/$platform.csv",$platform);
}

echo "done setup_db_translate.php<br>";
?>
