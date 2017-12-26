<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>sends and receives POST request</title>
  </head>
  <?php
    require_once($_GET['platform']."/tradingAPI.php");
  ?>

  <body>
    <a class = "json_response">
      <?php
        echo sendPOSTreq($_GET["cmd"], $_GET["args"]);
      ?>
    </a>
  </body>
</html>
