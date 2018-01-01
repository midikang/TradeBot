<?php // a set of functions that are specific to bitfinex's API
function call_func($cmd){
  switch($cmd){
    case "getCoinInfo":
      return getCoinInfo($_GET["coin"].$_GET["currency"]);

    case "getValidPairs":
    return getValidPairs();

    default:
        throwErr("cmd: '".$cmd."'");
  }
}

function getCoinInfo($pair = "ALL"){
  //echo $pair;
  if ($pair == "ALL"){
    $allInfo = array();
    $allPairs = json_decode(validPairs(), true);

    foreach ($allPairs as $crPair){
      $allInfo[$pair] = getCoinInfo($crPair);
    }

    return json_encode($allInfo);
  }
  $url = "https://api.bitfinex.com/v1/book/".$pair;

  return getJSONstr($url);
}

function getValidPairs(){
  $url = "https://api.bitfinex.com/v1/symbols";

  return getJSONstr($url);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */
?>
