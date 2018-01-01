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
  $allTickerStr = getCoinInfo();

  //print_r(json_decode( $allTickerStr, true ));
  return json_encode(array_keys(json_decode( $allTickerStr, true )));
}

function getCoinInfo($pair = 'ALL'){
  $url = "https://poloniex.com/public?command=returnTicker";

  $allTickerStr = getJSONstr($url);
  if ($pair == "ALL"){
    return $allTickerStr;
  }

  $tickerArr = json_decode(getJSONstr($url), true);

  //return json_encode($tickerArr[$pair]);
  return json_encode($tickerArr[strtoupper($pair)]);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

?>
