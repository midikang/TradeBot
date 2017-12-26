<?php // a set of functions that are specific to bitfinex's API
function sendGETreq($cmd){
switch($cmd){
  case "getCoinInfo":
    return getCoinInfo($_GET["pair"]);

  default:
      throwErr("cmd: '".$cmd."'");
}

}

function getCoinInfo($pair){
  $url = "https://api.bitfinex.com/v1/pubticker/".$pair;

  return getJSONstr($url);
}

/* add new more functions here
function ______($coin, $currency){
  $url = "";

  return getJSONstr($url);
}
// */
?>
