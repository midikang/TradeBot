<?php // a set of functions that are specific to bitfinex's API
require_once('zqis.php');  //setup vars $api_key and $api_secret
require_once('finex.php');
$postSender = new bitfinex($api_key, $api_secret);


function sendPOSTreq($cmd, $args){
  switch($cmd){
    case "getAccInfo":
    return postSender.account_info();
  default:
      throw new Exception("handling unknown cmd: '".$cmd."' in ".$_GET['platform'].'/'.$_GET['reqType']."_req.php");
  }
}


?>
