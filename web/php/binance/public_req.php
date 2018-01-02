<?php // a set of functions that are specific to poloniex's API
function call_func($cmd){
  switch($cmd){
    case "getOrderBook":
      return getOrderBook(strtoupper($_GET["coin"].$_GET["currency"]));

    case "getValidPairs":
      return getValidPairs();

    default:
      throwErr("cmd: '".$cmd."'");
  }
}

function getValidPairs() {
  $url = "https://api.binance.com/api/v1/ticker/allPrices";

  $allPrices = getJSON($url);
  $pairs = array();
  foreach ($allPrices as $crPair){
    array_push($pairs,$crPair['symbol']);
  }
  //print_r(json_decode( $allTickerStr, true ));
  return json_encode($pairs);
}

function getOrderBook($pair){
  $url = "https://api.binance.com/api/v1/depth?limit=5&symbol=".$pair;

  return getJSONstr($url);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

?>
