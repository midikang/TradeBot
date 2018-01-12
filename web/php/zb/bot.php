<?php
class zb extends trader{
  public function __construct($api_key, $api_secret){
    $this->withdrawFee = 0;

    parent::__construct($api_key, $api_secret, "https://trade.zb.com");
  }

  public function buy($pair, $amt, $price)
  {
    return $this->newOrder($pair, $amt, $price, 1); // 1 for "buy"
  }

  public function sell($pair, $amt, $price)
  {
    return $this->newOrder($pair, $amt, $price, 0); // 0 for "sell"
  }

  public function newOrder($symbol, $amount, $price, $side){
    $requestURL = "/api/order";

    $req = array(
      "accessKey" => $this->api_key,
      "method" => "order",
      "currency" => $symbol,
      "amount" => $amount,
      "price" => $price,
      "tradeType" => $side,
    );

    ksort($req);

    $post_data = http_build_query($req, '', '&amp;');
    // echo $post_data;
    $tSign=hash_hmac('md5',$post_data, sha1($this->api_secret));
    $req['sign'] = $tSign;
    $req['reqTime'] = time()*1000;
    $post_data= http_build_query($req, '', '&amp;');

    $url = $this->trading_url.$requestURL."?".$post_data;

    echo $url;

    $tCh = curl_init();
    curl_setopt($tCh, CURLOPT_POST, true);
    curl_setopt($tCh, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($tCh, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
    curl_setopt($tCh, CURLOPT_URL, $url);
    curl_setopt($tCh, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($tCh, CURLOPT_SSL_VERIFYPEER, false);
    $ccc = curl_exec($tCh);
    curl_close($tCh);
    return $ccc;

    return $this->query($data);
  }

  public function getBalances()
  {
    $requestURL = "/api/getAccountInfo";
    $req = array(
      "accesskey" => $this->api_key,
      "method" => 'getAccountInfo'
    );

    return $this->query($req, "GET", $requestURL);
  }

  protected function generateNonce(){
    return time()*1001;
  }

  protected function generatePostData($req){
    ksort($req);
		return http_build_query($req, '', '&amp;');
	}

  protected function generateHeaders($req, $post_data){
    return array(
       "Content-type: application/x-www-form-urlencoded"
    );
  }

  protected function query(array $req = array(), $method = "POST", $requestURL = "") {
    $post_data = $this->generatePostData($req);
    $signature = hash_hmac("md5", $post_data, sha1($this->api_secret));

    $headers = $this->generateHeaders($req, $post_data);
		$url = $this->trading_url."$requestURL?$post_data&sign=$signature&reqTime=".$this->generateNonce();
    // echo $url;
    return getJSONstr($url, $headers[0], $method);
	}


}
?>
