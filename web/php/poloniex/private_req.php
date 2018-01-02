<?php // a set of functions that are specific to poloniex's API

// poloniex definition of "pair": currency_coin

$postSender = new poloniex($api_key, $api_secret);

function call_func($cmd){
  switch($cmd){
    case "getBalances":
      return $GLOBALS['postSender']->getBalances();

    case "buy":
      return $GLOBALS['postSender']->buy($_GET["currency"]."_".$_GET["coin"], $_GET["price"], $_GET["amt"]);

    case "sell":
      return $GLOBALS['postSender']->sell($_GET["currency"]."_".$_GET["coin"], $_GET["price"], $_GET["amt"]);

    case "withdraw":
      return $GLOBALS['postSender']->withdraw();

  default:
      throwErr("cmd: '".$cmd."'");
  }
}


?>
