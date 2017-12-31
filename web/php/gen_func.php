<?php // functions that gets used by all php scripts

function getJSONstr($url){
  $opts = array('http' =>
    array(
      'method'  => 'GET',
      'timeout' => 10
    )
  );
  $context = stream_context_create($opts);
  $jsonStr = file_get_contents($url, false, $context);
  return $jsonStr;
}

function getJSON($url){
  return json_decode(getJSONstr($url), true);
}

function handlingErr($msg){
	throw new Exception("\n".$_GET['platform'].'/'.$_GET['reqType']."_req.php\nHandling unknown ".$msg);
}

?>
