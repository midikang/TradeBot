<?php // a set of functions that are specific to bitfinex's API
$postSender = new bitfinex($api_key, $api_secret);

function call_func($cmd){
  switch($cmd){
    case "getAccInfo":
      return $postSender->{account_info()};

    case "buy":
      return $postSender->{buy()};

    case "sell":
      return $postSender->{sell()};

    case: "withdraw":
      return $postSender->{withdraw()};

  default:
      throwErr("cmd: '".$cmd."'");
  }
}


?>
