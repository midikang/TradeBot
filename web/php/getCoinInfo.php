<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>gets coin to currency info</title>
  </head>
  <body>
    <a class = "json_response">
      <?php
        //json_decode(file_get_contents("https://api.bitfinex.com/v1/pubticker/".$_GET['coin'].$_GET['currency']),true));
        echo trim(file_get_contents("https://api.bitfinex.com/v1/pubticker/".$_GET['coin'].$_GET['currency']));
      ?>
    </a>
  </body>
</html>
