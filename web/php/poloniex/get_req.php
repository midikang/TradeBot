<?php // a set of functions that are specific to poloniex's API
function call_func($cmd){
  switch($cmd){
    case "getCoinInfo":
      return getCoinInfo( strtoupper($_GET["currency"]."_".$_GET["coin"]) );

    case "getValidPairs":
      return getValidPairs();

    default:
      throwErr("cmd: '".$cmd."'");
  }
}

function getValidPairs() {
  $url = "https://poloniex.com/public?command=returnOrderBook&currencyPair=ALL&depth=0";

  $allOrderBook = getJSON($url);

  //print_r(json_decode( $allTickerStr, true ));
  return json_encode(array_keys( $allOrderBook ));
}

function getCoinInfo($pair = 'ALL'){
  $url = "https://poloniex.com/public?command=returnOrderBook&currencyPair=".$pair."&depth=3";

  $orderBookStr = getJSONstr($url);

  return $orderBookStr;
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

?>
