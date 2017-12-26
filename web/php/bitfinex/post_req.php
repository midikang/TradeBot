<?php // a set of functions that are specific to bitfinex's API
require_once('zqis.php');  //setup vars $api_key and $api_secret
require_once('finex.php');
$postSender = new bitfinex($api_key, $api_secret);


function sendPOSTreq($cmd, $args){
  switch($cmd){
    case "getAccInfo":
    return postSender.account_info();
  default:
      throwErr("cmd: '".$cmd."'");
  }
}


?>
