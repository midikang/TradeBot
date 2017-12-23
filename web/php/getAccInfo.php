<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>gets Acc info</title>
  </head>
    <?php
    // didn't use include here because I don't want it to continue if error occurs
    require_once('finex.php'); // require_once <=> import once
    require_once('config.php'); // setup vars $api_key and $api_secret
    $trade = new bitfinex($api_key, $api_secret);
    ?>
    <a class = "json_response">
      <?php
      $trade->account_info();
      ?>
    </a>
  </body>
</html>
