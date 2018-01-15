project5: crypto-trading bot

Current v1.6 	(Support):
- figure out why cannot pass auth test for zb's trading req

		(Backend):
- implement 2 sub classes of Monitor, one checks single platform and one checks double platform

Next v2 (Backend)
- write processes, i.e. trading strategies

Next v3 (Log)
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
