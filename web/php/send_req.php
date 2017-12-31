<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>sends and receives GET/POST request</title>
  </head>

  <?php
    require_once("gen_func.php");

    if ($_GET['reqType'] == 'get'){
      require_once($_GET['platform']."/get_req.php");
    } else if ($_GET['reqType'] == 'post'){
      require_once($_GET['platform'].'zqis.php');  //setup vars $api_key and $api_secret
      require_once($_GET['platform'].'index.php');
      require_once($_GET['platform']."/post_req.php");
    }
  ?>

  <body>
    <a class = "json_response">
      <?php
        echo call_func($_GET['cmd']);
      ?>
    </a>

  </body>
</html>
