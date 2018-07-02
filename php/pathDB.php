<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>connects to SQL server for coin translation</title>
  </head>

  <body>
    <a class = "json_response">
      <?php
        if($_GET['cmd'] == "setup_db_path"){
          require_once("pathDB/setup_db_path.php");
        } else {
          require_once("pathDB/db_funcs.php");
          echo json_encode(call_func($_GET['cmd']));
        }
      ?>
    </a>

  </body>
</html>
