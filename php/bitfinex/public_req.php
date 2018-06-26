<?php // a set of functions that are specific to bitfinex's API
function call_func($cmd){
  switch($cmd){
    case "getOrderBook":
      return getOrderBook($_GET["coin"].$_GET["currency"]);

    case "getValidPairs":
    return getValidPairs();

  default:
      die("unrecognized translate command:       $cmd");
  }
}

function getOrderBook($pair){
  $url = "https://api.bitfinex.com/v1/book/".$pair;

  return getJSON($url);
}

function getValidPairs(){
  $url = "https://api.bitfinex.com/v1/symbols";

  return getJSON($url);
}

?>
