<?php
	// FINAL TESTED CODE - Created by Compcentral

	// NOTE: currency pairs are reverse of what most exchanges use...
	//       For instance, instead of XPM_BTC, use BTC_XPM

class poloniex {
	private $api_key;
	private $api_secret;
	private $trading_url = "https://poloniex.com/tradingApi";
	private $public_url = "https://poloniex.com/public";

	public function __construct($api_key, $api_secret) {
		$this->api_key = $api_key;
		$this->api_secret = $api_secret;
	}

	private function query(array $req = array()) {
		// generate a nonce to avoid problems with 32bit systems
    $mt = explode(' ', microtime());
    $req['nonce'] = $mt[1].substr($mt[0], 2, 6);

    // generate the POST data string
    $post_data = http_build_query($req, '', '&');
    $sign = hash_hmac('sha512', $post_data, $api_secret);

		// generate the extra headers
		$headers = array(
			'Key: '.$this->api_key,
			'Sign: '.$sign,
		);

		$ch = curl_init();
		curl_setopt_array($ch, array(
			 CURLOPT_URL => $this->trading_url,
			 CURLOPT_POST => true,
			 CURLOPT_RETURNTRANSFER => true,
			 CURLOPT_HTTPHEADER => $headers,
			 CURLOPT_SSL_VERIFYPEER => false,
			 CURLOPT_POSTFIELDS => $post_data
		));

		$res = curl_exec($ch);

		if ($res === false) throw new Exception('Curl error: '.curl_error($ch));
		//echo $res;
		return json_decode($res, true);
	}

	protected function retrieveJSON($URL) {
		$opts = array('http' =>
			array(
				'method'  => 'GET',
				'timeout' => 10
			)
		);
		$context = stream_context_create($opts);
		$feed = file_get_contents($URL, false, $context);
		$json = json_decode($feed, true);
		return $json;
	}

	public function get_balances() {
		return $this->query(
			array(
				'command' => 'returnBalances'
			)
		);
	}

	public function get_open_orders($pair) {
		return $this->query(
			array(
				'command' => 'returnOpenOrders',
				'currencyPair' => strtoupper($pair)
			)
		);
	}

	public function get_my_trade_history($pair) {
		return $this->query(
			array(
				'command' => 'returnTradeHistory',
				'currencyPair' => strtoupper($pair)
			)
		);
	}

	public function buy($pair, $rate, $amount) {
		return $this->query(
			array(
				'command' => 'buy',
				'currencyPair' => strtoupper($pair),
				'rate' => $rate,
				'amount' => $amount
			)
		);
	}

	public function sell($pair, $rate, $amount) {
		return $this->query(
			array(
				'command' => 'sell',
				'currencyPair' => strtoupper($pair),
				'rate' => $rate,
				'amount' => $amount
			)
		);
	}

	public function cancel_order($pair, $order_number) {
		return $this->query(
			array(
				'command' => 'cancelOrder',
				'currencyPair' => strtoupper($pair),
				'orderNumber' => $order_number
			)
		);
	}

	public function withdraw($currency, $amount, $address) {
		return $this->query(
			array(
				'command' => 'withdraw',
				'currency' => strtoupper($currency),
				'amount' => $amount,
				'address' => $address
			)
		);
	}

	public function get_trade_history($pair) {
		$trades = $this->retrieveJSON($this->public_url.'?command=returnTradeHistory&currencyPair='.strtoupper($pair));
		return $trades;
	}

	public function get_order_book($pair) {
		$orders = $this->retrieveJSON($this->public_url.'?command=returnOrderBook&currencyPair='.strtoupper($pair));
		return $orders;
	}

	public function get_volume() {
		$volume = $this->retrieveJSON($this->public_url.'?command=return24hVolume');
		return $volume;
	}

	public function get_ticker($pair = "ALL") {
		$pair = strtoupper($pair);
		$prices = $this->retrieveJSON($this->public_url.'?command=returnTicker');
		if($pair == "ALL"){
			return $prices;
		}else{
			if(isset($prices[$pair])){ // check whether the given key exists
				return $prices[$pair];
			}else{
				return array();
			}
		}
	}

	public function get_trading_pairs() {
		$tickers = $this->retrieveJSON($this->public_url.'?command=returnTicker');
		return array_keys($tickers);
	}

	public function get_total_btc_balance() {
		$balances = $this->get_balances();
		$prices = $this->get_ticker();

		$tot_btc = 0;

		foreach($balances as $coin => $amount){
			$pair = "BTC_".strtoupper($coin);

			// convert coin balances to btc value
			if($amount > 0){
				if($coin != "BTC"){
					$tot_btc += $amount * $prices[$pair];
				}else{
					$tot_btc += $amount;
				}
			}

			// process open orders as well
			if($coin != "BTC"){
				$open_orders = $this->get_open_orders($pair);
				foreach($open_orders as $order){
					if($order['type'] == 'buy'){
						$tot_btc += $order['total'];
					}elseif($order['type'] == 'sell'){
						$tot_btc += $order['amount'] * $prices[$pair];
					}
				}
			}
		}

		return $tot_btc;
	}
}
?>
