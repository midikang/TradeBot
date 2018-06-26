<?php // a set of functions that are specific to bitfinex's API
function call_func($cmd){
  switch($cmd){
    case "getOrderBook":
      return getOrderBook($_GET['coin'].'_'.$_GET['currency']);

    case "getValidPairs":
    return getValidPairs();

    default:
        die("unrecognized cmd: $cmd");
  }
}

function getOrderBook($pair){
  $url = "https://yobit.net/api/3/depth/$pair?limit=3";

  return getJSONstr($url);
}

function getValidPairs(){
  $url = "https://yobit.net/api/3/info";

  $allPairsToInfo = getJSON($url)["pairs"];

  return json_encode(array_keys( $allPairsToInfo ));
}

?>
