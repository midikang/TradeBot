<?php // a set of functions that are specific to poloniex's API
function sendGETreq($cmd){
  switch($cmd){
    case "getCoinInfo":
      return getCoinInfo($_GET["pair"]);

    case "getTradeHistory":
      return getTradeHistory();

    case "getTradingPairs":
      return getTradingPairs();

    default:
      throwErr("cmd: '".$cmd."'");
  }
}

function getAllCoinsInfo(){
  $url = "https://poloniex.com/public?command=returnTicker";

  return getJSONstr($url);
}

function getTradingPairs() {
  return array_keys(json_decode( getAllCoinsInfo(), true ));
}

function getCoinInfo($pair){
  $allTicker = json_decode(getAllCoinsInfo(), true);

  return json_encode($allTicker[strtoupper($pair)]);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

?>
