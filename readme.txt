project5: crypto-trading bot

Next v1.1 (Backend):
- timed call of GET request and display parsed info

- create arrays to store info from GET request

- try to send POST requests for other things (e.g. acc info)


Basic Design:
	(Backend - Python)
- timed GET requests for info from bitfinex's server;

- sends requests to bitfinex to trade

	(Frontend - HTML/JS/CSS)
- basic layout of 6 panels:
	graph pane: 	shows the trend / data over a long period of time
	setting pane:	optional settings for update period/frequency, domain of graphical display
	details pane:	shows detail(numbers) of a certain datetime
	update pane:	shows the most info/numbers that's acquired
	action pane:	buttons for buy/sell coins on bitfinex platform
	acc info pane:	shows basic info of acc, e.g. amt of money, amt of currency


Additions:
- frontend is very ambitious; no idea if it'll ever be implemented

Issues:
- sending POST requests using python to bitfinex's server

Credit:
	the project uses github.com/coinables' php code that works with bitfinex's API.

