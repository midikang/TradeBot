<?php
class bitfinex extends trader{
  private $orderType, $minTradeAmt;

  public function __construct($api_key, $api_secret){
    $this->orderType = 'LIMIT';
    $this->minTradeAmt = 0.04;
    
    parent::__construct($api_key, $api_secret, "https://api.bitfinex.com");
  }

  public function buy($pair, $amt, $price)
  {
    return $this->newOrder($pair, $amt, $price, "buy");
  }

  public function sell($pair, $amt, $price)
  {
    return $this->newOrder($pair, $amt, $price, "sell");
  }

  public function newOrder($symbol, $amount, $price, $side)
  {
    $requestURL = "/v1/order/new";
    $data = array(
       "request" => $requestURL,
       "symbol" => $symbol,
       "amount" => $amount,
       "price" => $price,
       "exchange" => "bitfinex",
       "side" => $side,
       "type" => $this->orderType
    );

    return $this->query($data, $requestURL);
  }

  public function cancel_order($order_id)
  {
    $requestURL = "/v1/order/cancel";
    $data = array(
     "request" => $requestURL,
     "order_id" => (int)$order_id
    );
    return $this->query($data, $requestURL);
  }

  public function cancel_all()
  {
    $requestURL = "/v1/order/cancel/all";
    $data = array(
      "request" => $requestURL
    );
    return $this->query($data);
  }

  public function getTradingFees()
  {
    $request = "/v1/account_infos";
    $data = array(
      "request" => $request
    );

    $this->trading_url = $this->trading_url . $request;
    return $this->query($data);
  }

  public function getWithdrawlFees(){
    $request = "/v1/account_fees";
    $data = array(
      "request" => $request
    );

    $this->trading_url = $this->trading_url . $request;
    return $this->query($data);
  }

  public function getBalances()
  {
    $requestURL = "/v1/balances";
    $data = array(
      "request" => $requestURL
    );

    return $this->query($data, $requestURL);
  }

  protected function generateHeaders($req, $post_data)
  {
    $payload = base64_encode(json_encode($req));
    $signature = hash_hmac("sha384", $payload, $this->api_secret);
    return array(
       "X-BFX-APIKEY: " . $this->api_key,
       "X-BFX-PAYLOAD: " . $payload,
       "X-BFX-SIGNATURE: " . $signature
    );
  }
/*
  public function deposit($method, $wallet, $renew)
  {
    $request = "/v1/deposit/new";
    $data = array(
      "request" => $request,
      "method" => $method,
      "wallet_name" => $wallet,
      "renew" => $renew
    );
    return $this->query($data);
  }

  public function transfer($amount, $currency, $from, $to)
  {
    $request = "/v1/transfer";
    $data = array(
      "request" => $request,
      "amount" => $amount,
      "currency" => $currency,
      "walletfrom" => $from,
      "walletto" => $to
    );
    return $this->query($data);
  }
  // */



}
?>
