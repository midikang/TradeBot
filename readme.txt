project5: crypto-trading bot

Support v1.6:
- figure out why cannot pass auth test for zb's trading req


Main v2.2:
- implement different sub classes of trader that handles different aspects of trading, 
	in this order:
	checker, orderer, distributor, logger

- test the bots
translator, generator

- incorporate the translator bot into the implementation of zclasses/zfuncs/tp_funcs.py's functions and test it



- how to decide how much to trade for a given process
- logger to see monthly progress with a given process


Basic Design:
	(Main - Python)
- Where the main processing is handled

- Using localhost to send requests to trading platforms via different .php files

	(Support - php/HTML)
- Where the most of the user specific i/o is handled

- variety of .php files that performs different tasks


References Used:
	- github |coinables|: php wrapper for bitfinex API
	- pastebin |compcentral|: php wrapper for poloniex API
	- github |ccxt|: php wrapper yobit and zb API
