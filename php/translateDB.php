<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>connects to SQL server for coin translation</title>
  </head>

  <body>
    <a class = "json_response">
      <?php
        if($_GET['cmd'] = setup_db_translate){
          require_once("translateDB/setup_db_translate.php");
        } else {
          require_once(translateDB/db_funcs.php);
          echo json_encode(call_func($_GET['cmd']));
        }
      ?>
    </a>

  </body>
</html>
