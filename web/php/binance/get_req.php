<?php // a set of functions that are specific to binance's API
function sendGETreq($cmd){
  switch($cmd){
    case "getCoinInfo":
      return getCoinInfo($_GET["pair"]);

    case "getAllCoinsInfo":
      return getAllCoinsInfo();

    case "getTradeHistory":
      return getTradeHistory();

    case "getTradingPairs":
      return getTradingPairs();

    default:
      throwErr("cmd: '".$cmd."'");
  }
}

function getAllCoinsInfo(){
  $url = "https://api.binance.com/api/v1/ticker/allBookTickers";

  return getJSONstr($url);
}

function getTradingPairs() {
  return array_keys(json_decode( getAllCoinsInfo(), true ));
}

function getCoinInfo($targetPair){
  $allTicker = json_decode(getAllCoinsInfo(), true);

  foreach($allTicker as $obj){
	if ($obj['symbol'] == $targetPair){
		return json_encode($obj);
	}
  }

  throwErr("pair: '".$targetPair."'");

  
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */

?>
