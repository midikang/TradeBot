<?php
class binance extends trader{

  public function __construct($api_key, $api_secret)
  {
     parent::__construct($api_key, $api_secret, "https://api.binance.com");
  }

  public function buy($pair, $amt, $price, $type)
  {
    return $this->newOrder($pair, $amt, $price, "buy");
  }

  public function sell($pair, $amt, $price, $type)
  {
    return $this->newOrder($pair, $amt, $price, "sell");
  }

  public function newOrder($pair, $amount, $price, $side)
  {
    $request = "/v1/order/new";
    $data = array(
       "symbol" => $pair,
       "amount" => $amount,
       "price" => $price,
       "side" => $side,
    );

    $this->trading_url = $this->trading_url . $request;
    return $this->query($data);
  }

  /*
  public function cancel_order($order_id)
  {
    $request = "/v1/order/cancel";
    $data = array(

     "order_id" => (int)$order_id
    );
    return $this->query($data);
  }

  public function cancel_all()
  {
    $request = "/v1/order/cancel/all";
    $data = array(
    );
    return $this->query($data);
  }

  // */

  public function getBalances()
  {
    $request = "/api/v3/account";
    $data = array(
      "timestamp" => $this->generateNonce()
    );

    $post_data = $this->generatePostData($data);
    $url = $this->trading_url . $request."?".$post_data;

    $headers = $this->generateHeaders($data, $post_data);

    echo $url;
		$ch = curl_init();
		curl_setopt_array($ch, array(
			 CURLOPT_URL => $url,
			 CURLOPT_POST => false,
			 CURLOPT_RETURNTRANSFER => true,
			 CURLOPT_HTTPHEADER => $headers,
			 CURLOPT_SSL_VERIFYPEER => false,
			 CURLOPT_POSTFIELDS =>""
		));

		$res = curl_exec($ch);

		if ($res === false) throw new Exception('Curl error: '.curl_error($ch));
		return $res;
  }

  protected function generatePostData($req){
    $queryStr = http_build_query($req, '', '&');
    $signature = hash_hmac("sha256", $queryStr, $this->api_secret);
    $req['signature'] = $signature;

    return http_build_query($req, '', '&');
  }

  protected function generateHeaders($req, $post_data)
  {
    return array(
       "X-MBX-APIKEY: " . $this->api_key,
    );
  }

  protected function query(array $req = array(), $isPost = true) {
		$this->setNonce($req);

		$post_data = "";//$this->generatePostData($req);

		$headers = $this->generateHeaders($req, $post_data);

		$ch = curl_init();
		curl_setopt_array($ch, array(
			 CURLOPT_URL => $this->trading_url,
			 CURLOPT_POST => $isPost,
			 CURLOPT_RETURNTRANSFER => true,
			 CURLOPT_HTTPHEADER => $headers,
			 CURLOPT_SSL_VERIFYPEER => false,
			 CURLOPT_POSTFIELDS => $post_data
		));

		$res = curl_exec($ch);

		if ($res === false) throw new Exception('Curl error: '.curl_error($ch));
		return $res;
	}

}
?>
