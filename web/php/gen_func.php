<?php // functions that gets used by all php scripts

function getJSONstr($url, $headers = "", $method = "GET"){
  $opts = array('http' =>
    array(
      'method'  => $method,
      'timeout' => 10,
      'header'  => $headers
    )
  );

  $context = stream_context_create($opts);
  $jsonStr = file_get_contents($url, false, $context);
  return $jsonStr;
}

function getJSON($url, $headers = ""){
  return json_decode(getJSONstr($url, $headers), true);
}

function handlingErr($msg){
	throw new Exception("\n".$_GET['platform'].'/'.$_GET['reqType']."_req.php\nHandling unknown ".$msg);
}

?>
