<?php
	// FINAL TESTED CODE - Created by Compcentral

	// NOTE: currency pairs are reverse of what most exchanges use...
	//       For instance, instead of XPM_BTC, use BTC_XPM

class poloniex extends trader{
	public function __construct($api_key, $api_secret) {
		 parent::__construct($api_key, $api_secret, "https://poloniex.com/tradingApi");
	}

	protected function generatePostData($req){
		return http_build_query($req, '', '&');
	}

	protected function generateHeaders($req, $post_data)
	{
		$payload = base64_encode(json_encode($req));
		$signature = hash_hmac('sha512', $post_data, $this->api_secret);
		return array(
			'Key: '.$this->api_key,
			'Sign: '.$signature
		);
	}

	public function getBalances() {
		return $this->query(
			array(
				'command' => 'returnBalances'
			)
		);
	}

	public function buy($pair, $rate, $amt) {
		return $this->newOrder("buy", $pair, $rate, $amt);
	}

	public function sell($pair, $rate, $amt) {
		return $this->newOrder("sell", $pair, $rate, $amt);
	}

	protected function newOrder($side, $pair, $rate, $amt){
		return $this->query(
			array(
				'command' => $side,
				'currencyPair' => strtoupper($pair),
				'rate' => $rate,
				'amount' => $amount
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

	/*
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

	public function cancel_order($pair, $order_number) {
		return $this->query(
			array(
				'command' => 'cancelOrder',
				'currencyPair' => strtoupper($pair),
				'orderNumber' => $order_number
			)
		);
	}

	public function getTicker($pair = "ALL") {
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

	public function get_total_btc_balance() {
		$balances = $this->getBalances();
		$prices = $this->getTicker();

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

	// */
}
?>
