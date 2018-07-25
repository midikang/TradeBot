<?php
class binance extends trader{
  private $orderType, $recvWindow, $timeInForce;

  public function __construct($api_key, $api_secret){
    $this->orderType = 'LIMIT';
    $this->recvWindow = 6000;
    $this->timeInForce = "GTC";

    $this->withdrawFee = 0;

    parent::__construct($api_key, $api_secret, "https://api.binance.com");
  }

  public function buy($pair, $amt, $price)
  {
    return $this->newOrder($pair, $amt, $price, "BUY");
  }

  public function sell($pair, $amt, $price)
  {
    return $this->newOrder($pair, $amt, $price, "SELL");
  }

  public function newOrder($pair, $amount, $price, $side) {
    if ($amount < $this->minTradeAmt){
      invalidErr("trade amt = $amount < min amt = {$this->minTradeAmt}");
    }
    //$request = "/api/v3/order";
    $request = "/api/v3/order/test"; // doesn't actually put up order if request succ
    $req = array(
       "symbol" => $pair,
       "side" => $side,
       "type" => $type,
       "timeInForce" => $this->timeInForce,
       "quantity" => $amount,
       "price" => $price,
       "recvWindow" => $this->recvWindow
    );

    $this->trading_url = $this->trading_url . $request;
    return $this->query($req);
  }

  public function getBalances()
  {
    $requestURL = "/api/v3/account";
    $req = array(
    );

    return $this->query($req, "GET", $requestURL);
  }

  protected function generateNonce(){
    return number_format(microtime(true)*1000,0,'.','');
  }

  protected function setNonce($req){
    $req['timestamp'] = $this->generateNonce();
    return $req;
  }

  protected function generatePostData($req){
    return http_build_query($req, '', '&');
  }

  protected function generateHeaders($req, $post_data)
  {
    return array("X-MBX-APIKEY: " . $this->api_key);
  }

  protected function query(array $req = array(), $method = "POST", $requestURL = "") {
    $req = $this->setNonce($req);

    $post_data = $this->generatePostData($req);
    $signature = hash_hmac("sha256", $post_data, $this->api_secret);

    $headers = $this->generateHeaders($req, $post_data);
		$url = $this->trading_url."$requestURL?$post_data&signature=$signature";

    return getJSON($url, $headers[0], $method);
	}


}
?>
