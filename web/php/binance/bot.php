<?php
class binance extends trader{
  private $orderType, $recvWindow, $minTradeAmt, $timeInForce;

  public function __construct($api_key, $api_secret){
    $this->minTradeAmt = 0.02;
    $this->orderType = 'LIMIT';
    $this->recvWindow = 6000;
    $this->timeInForce = "GTC";
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
    $request = "/api/v3/account";
    $req = array(
    );

    $this->trading_url = $this->trading_url.$request;
    return $this->query($req, "GET");
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
    return "X-MBX-APIKEY: " . $this->api_key;
  }

  protected function query(array $req = array(), $method = "POST") {
    $req = $this->setNonce($req);

    $queryStr = $this->generatePostData($req);
    $signature = hash_hmac("sha256", $queryStr, $this->api_secret);

    $headers = $this->generateHeaders($req, $queryStr);
		$url = $this->trading_url."?".$queryStr."&signature=".$signature;
    return getJSONstr($url, $headers, $method);
	}


}
?>
