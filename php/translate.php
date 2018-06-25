<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>connects to SQL server for coin translation</title>
  </head>

  <body>
    <a class = "json_response">
      <?php
        require_once("translateDB/look_up_functions.php");

        echo call_func($_GET['cmd']);
      ?>
    </a>

  </body>
</html>
