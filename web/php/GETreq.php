<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>sends and receives GET request</title>
  </head>

  <?php
    require_once($_GET['platform']."/publicAPI.php");
  ?>

  <body>
    <a class = "json_response">
      <?php
        //json_decode(file_get_contents("https://api.bitfinex.com/v1/pubticker/".$_GET['coin'].$_GET['currency']),true));
        echo sendGETreq($_GET["cmd"]);
      ?>
    </a>
  </body>
</html>
