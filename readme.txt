project5: crypto-trading bot

Support v1.6:
- wait for api to be released by new platforms
- try to get MySQL setup to store all the translation info under python\zclasses\coins
	this way the need to make different instances of 
	the same translator bot can be eliminated

Main v2.3:
- implement and test the checker class

- implement module #3




Basic Design:
	(Main - Python)
- Where the main processing is handled

- Using localhost to send requests to trading platforms via different .php files

	(Support - php/HTML)
- Where the most of the user specific i/o is handled

- variety of .php files that performs different tasks


- there are 6 classes that handles different aspects of trading, 
	in this order:
	generator, checker, translator, orderer, logger, distributor

- implement the 5 modules that is used:
	1. generate paths
	2. storing paths
	3. select paths and constructing obj using what is stored
	4. monitoring
	5. trading
	opt. logging and outputing reports for analysis

References Used:
	- github |coinables|: php wrapper for bitfinex API
	- pastebin |compcentral|: php wrapper for poloniex API
	- github |ccxt|: php wrapper yobit and zb API
