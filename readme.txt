project5: crypto-trading bot

Basic Design:
	(Main - Python)
- Where the main processing is handled

- Using localhost to send requests to trading platforms via different .php files

	(Support - php/HTML)
- Where the most of the user specific i/o is handled

- variety of .php files that performs different tasks


- there are 5 classes that handles different aspects of trading, 
	in this order:
	generator, checker, orderer, logger, distributor

- implement the 5 modules that is used:
	1. generate paths
	2. storing paths on database (MySQL server)
	3. ui for choosing paths to be monitored 
	4. monitoring
	5. trading
	opt. logging and outputing reports for analysis

References Used:
	- github |coinables|: php wrapper for bitfinex API
	- pastebin |compcentral|: php wrapper for poloniex API
	- github |ccxt|: php wrapper yobit and zb API
