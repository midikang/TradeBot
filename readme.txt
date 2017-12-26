project5: crypto-trading bot

Next v1.1 (Backend):
- timed call of GET request and display parsed info

- try to send POST requests for other things (e.g. acc info)


Basic Design:
	(Main - Python)
- Where the main processing is handled

- Can send GET request on its own

- Using localhost to send requests to trading platforms via different .php files

	(Support - php/HTML)
- Where the most of the user specific i/o is handled

- variety of .php files that performs different tasks; each .php file sends a unique POST request


Issues:
- sending POST requests using python to bitfinex's server

Credit:
	- github |coinables|: php wrapper for bitfinex API
	- pastebin |compcentral|: php wrapper for poloniex API

