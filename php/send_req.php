<?php
  require_once("gen_func.php");

  if ($_GET['reqType'] == 'public'){
    require_once($_GET['platform']."/public_req.php");
  } else if ($_GET['reqType'] == 'private'){
    require_once('trader.php');
    require_once($_GET['platform'].'/zqis.php');  //setup vars $api_key and $api_secret
    require_once($_GET['platform'].'/bot.php');
    require_once($_GET['platform'].'/private_req.php');
  }

  echo json_encode(call_func($_GET['cmd']));
?>
