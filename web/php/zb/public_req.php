<?php // a set of functions that are specific to bitfinex's API
function call_func($cmd){
  switch($cmd){
    case "getOrderBook":
      return getOrderBook(strtolower($_GET['coin'].'_'.$_GET['currency']));

    case "getValidPairs":
    return getValidPairs();

    default:
        throwErr("cmd: '".$cmd."'");
  }
}

function getOrderBook($pair){
  $url = "http://api.zb.com/data/v1/depth?market=$pair&size=3";

  return getJSONstr($url);
}

function getValidPairs(){
  $url = "http://api.zb.com/data/v1/markets";

  $allPairsToInfo = getJSON($url);

  return json_encode(array_keys( $allPairsToInfo ));
}

?>
