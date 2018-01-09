project5: crypto-trading bot

Current v1.4 (Support):
- test and finish implementing yobit's .php files

Next v2.1 (Backend):
- write processes / trading strategies
- how to decide how much to trade for a given process
- logger to see monthly progress with a given process

Basic Design:
	(Main - Python)
- Where the main processing is handled

- Using localhost to send requests to trading platforms via different .php files

	(Support - php/HTML)
- Where the most of the user specific i/o is handled

- variety of .php files that performs different tasks; each .php file sends a unique POST request


Credit:
	- github |coinables|: php wrapper for bitfinex API
	- pastebin |compcentral|: php wrapper for poloniex API

