<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>connects to SQL server for coin translation</title>
  </head>

  <body>
    <a class = "json_response">
      <?php
        switch($_GET['cmd']){
          case "setup_db_translate":
            require_once("translateDB/setup_db_translate.php");
            break;

          case "getPlatforms":
            require_once("translateDB/helper_func.php");
            echo json_encode(getPlatforms());
        }
      ?>
    </a>

  </body>
</html>
