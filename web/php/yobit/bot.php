<?php
class yobit extends trader{
  public function __construct($api_key, $api_secret){
    $this->withdrawFee = 0;

    parent::__construct($api_key, $api_secret, "https://yobit.net/tapi");
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
    $data = array(
      "method" => "Trade",
      "pair" => $symbol,
      "amount" => $amount,
      "rate" => $price,
      "type" => $side,
    );

    return $this->query($data);
  }

  public function getBalances()
  {
    $data = array(
      "method" => "getInfo"
    );

    return $this->query($data);
  }

  protected function generateNonce(){
    $tmp = round(microtime(true) / 2147483646,0);
    return strval($tmp);
  }

  protected function generatePostData($req){
		return http_build_query($req, '', '&');
	}

  protected function generateHeaders($req, $post_data)
  {
    $signature = hash_hmac("sha512", $post_data, $this->api_secret);
    return array(
       "Key: ".$this->api_key,
       'Sign: '.$signature
    );
  }


}
?>
