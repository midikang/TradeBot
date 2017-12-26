<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>sends and receives GET/POST request</title>
  </head>

  <?php
    require_once($_GET['platform']."/".$_GET['reqType']."_req.php");
    require_once("gen_func.php");
  ?>

  <body>
    <a class = "json_response">
      <?php
        echo sendGETreq($_GET["cmd"]);
      ?>
    </a>
  </body>
</html>
