<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>connects to SQL server for path manipulation</title>
  </head>

  <body>
    <a class = "json_response">
      <?php
        require_once("pathDB/insert_delete_functions.php");

        call_func($_GET['cmd']);
      ?>
    </a>

  </body>
</html>
