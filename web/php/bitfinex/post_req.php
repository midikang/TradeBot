<?php // a set of functions that are specific to bitfinex's API

$postSender = new bitfinex($api_key, $api_secret);

function call_func($cmd){
  switch($cmd){
    case "getBalances":
      return $GLOBALS['postSender']->getBalances();

    case "buy":
      return $GLOBALS['postSender']->buy();

    case "sell":
      return $GLOBALS['postSender']->sell();

    case "withdraw":
      return $GLOBALS['postSender']->withdraw();

  default:
      throwErr("cmd: '".$cmd."'");
  }
}


?>
