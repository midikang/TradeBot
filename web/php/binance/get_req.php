<?php // a set of functions that are specific to poloniex's API
function call_func($cmd){
  switch($cmd){
    case "getCoinInfo":
      return getCoinInfo($_GET["currency"]."_".$_GET["coin"]);

    case "getValidPairs":
      return getValidPairs();

    default:
      throwErr("cmd: '".$cmd."'");
  }
}

function getValidPairs() {
  $url = "https://api.binance.com/api/v1/ticker/allPrices";
  $allTickerStr = getCoinInfo();

  //print_r(json_decode( $allTickerStr, true ));
  return json_encode(array_keys(json_decode( $allTickerStr, true )));
}

function getCoinInfo($pair = 'ALL'){
  $urlSingleTicker = "https://api.binance.com/api/v1/ticker/24hr?symbol="

  if ($pair == "ALL"){
    $urlAllPrices = "https://api.binance.com/api/v1/ticker/allPrices";

    $allPrices = getJSON($urlAllPrices);
    $allTickers = {};
    foreach ($allPrices as $crPair){
      $allTickers[$crPair['symbol']] = getJSON($urlSingleTicker.$crPair);
    }

    return json_encode($allTickers);
  }

  $allPrices = getJSONstr($urlSingleTicker.$crPair);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

?>
