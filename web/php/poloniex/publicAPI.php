<?php // a set of functions that are specific to bitfinex's API
function sendGETreq($cmd){
  switch($cmd){
    case "getCoinInfo":
      return getCoinInfo($_GET["coin"]);

    case "getTradeHistory":
      return getTradeHistory();

    case "getTradingPairs":
      return getTradingPairs();

    default:
      throw new Exception("handling unknown cmd: '".$cmd."' in bitfinex publicAPI.php");
  }
}

function getAllCoinsInfo(){
  $url = "https://poloniex.com/public?command=returnTicker";

  return getJSONstr($url);
}

public function getTradingPairs() {
  return array_keys(json_decode( getAllCoinsInfo(), true ));
}

function getCoinInfo($coin){
  $allTicker = json_decode(getAllCoinsInfo(), true);

  return json_encode($allTicker[strtoupper('btc_'.$coin)]);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

function getJSONstr($url){
  $opts = array('http' =>
    array(
      'method'  => 'GET',
      'timeout' => 10
    )
  );
  $context = stream_context_create($opts);
  $feed = file_get_contents($url, false, $context);
  return $feed;
}
?>
