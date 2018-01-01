<?php
class bitfinex extends trader{

  public function __construct($api_key, $api_secret)
  {
     parent::__construct($api_key, $api_secret, "https://api.bitfinex.com", "https://api.bitfinex.com");
  }

  public function buy($pair, $amt, $price, $type)
  {
    return $this->newOrder($pair, $amt, $price, "buy", $type);
  }

  public function sell($pair, $amt, $price, $type)
  {
    return $this->newOrder($pair, $amt, $price, "sell", $type);
  }

  public function newOrder($symbol, $amount, $price, $side, $type)
  {
    $request = "/v1/order/new";
    $data = array(
       "request" => $request,
       "symbol" => $symbol,
       "amount" => $amount,
       "price" => $price,
       "exchange" => "bitfinex",
       "side" => $side,
       "type" => $type
    );

    $this->trading_url = $this->trading_url . $request;
    return $this->query($data);
  }

  public function cancel_order($order_id)
  {
    $request = "/v1/order/cancel";
    $data = array(
     "request" => $request,
     "order_id" => (int)$order_id
    );
    return $this->query($data);
  }

  public function cancel_all()
  {
    $request = "/v1/order/cancel/all";
    $data = array(
      "request" => $request
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
    $request = "/v1/balances";
    $data = array(
      "request" => $request
    );

    $this->trading_url = $this->trading_url . $request;
    return $this->query($data);
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

  public function positions()
  {
    $request = "/v1/positions";
    $data = array(
      "request" => $request
    );
    return $this->query($data);
  }

  public function close_position($position_id)
  {
    $request = "/v1/position/close";
    $data = array(
      "request" => $request,
      "position_id" => (int)$position_id
    );
    return $this->query($data);
  }

  public function claim_position($position_id, $amount)
  {
    $request = "/v1/position/claim";
    $data = array(
      "request" => $request,
      "position_id" => (int)$position_id,
      "amount" => $amount
    );
    return $this->query($data);
  }

  public function margin_infos()
  {
    $request = "/v1/margin_infos";
    $data = array(
      "request" => $request
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

}
?>
