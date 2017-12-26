<?php // a set of functions that are specific to bitfinex's API
function sendGETreq($cmd){
switch($cmd){
  case "getCoinInfo":
    return getCoinInfo($_GET["coin"], $_GET["currency"]);

  default:
    throw new Exception("handling unknown cmd: '".$cmd."' in bitfinex publicAPI.php");
}

}

function getCoinInfo($coin, $currency){
  $url = "https://api.bitfinex.com/v1/pubticker/".$coin.$currency;

  return getJSONstr($url);
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
