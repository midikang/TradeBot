<?php // a set of functions that are specific to bitfinex's API
function call_func($cmd){
  switch($cmd){
    case "getOrderBook":
      return getOrderBook($_GET['coin'].'_'.$_GET['currency']);

    case "getValidPairs":
    return getValidPairs();

    default:
        die("unrecognized translate command:       $cmd");
  }
}

function getOrderBook($pair){
  $url = "https://yobit.net/api/3/depth/$pair?limit=3";

  return getJSON($url);
}

function getValidPairs(){
  $url = "https://yobit.net/api/3/info";

  $allPairsToInfo = getJSON($url)["pairs"];

  return array_keys( $allPairsToInfo );
}

?>
