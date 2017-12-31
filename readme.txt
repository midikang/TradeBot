project5: crypto-trading bot

Next v1.2 (Backend):
- write a sample process that detects opportunity for arbitrage

- write a super class trader.py that will increase code reusability 
	the post_sender class in each platform folder will extend this super class

- try to send POST requests for other things (e.g. acc info)


Basic Design:
	(Main - Python)
- Where the main processing is handled

- Using localhost to send requests to trading platforms via different .php files

	(Support - php/HTML)
- Where the most of the user specific i/o is handled

- variety of .php files that performs different tasks; each .php file sends a unique POST request


Issues:
- sending POST requests using python to specified servers

Credit:
	- github |coinables|: php wrapper for bitfinex API
	- pastebin |compcentral|: php wrapper for poloniex API

