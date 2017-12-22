project5: crypto-trading bot

Next v1.0 (Backend):
- test out php with html

- parse relevant info from json

- timed call of GET request and display parsed info

- create arrays to store info from GET request

- try to get info for other things (e.g. acc info)

- Begin front end stuff (commence databinding)



Basic Design:
	(Backend)
- timed call to get info from bitfinex's server; regularly update diff arrays of info

- databind the diff arrays to panels that has visual display of info

	(Frontend)
- basic layout of 6 panels:
	graph pane: 	shows the trend / data over a long period of time
	setting pane:	optional settings for update period/frequency, domain of graphical display
	details pane:	shows detail(numbers) of a certain datetime
	update pane:	shows the most info/numbers that's acquired
	action pane:	buttons for buy/sell coins on bitfinex platform
	acc info pane:	shows basic info of acc, e.g. amt of money, amt of currency


Additions:
- 

Issues:
-

Credit:
	the project uses github.com/coinables' php code that works with bitfinex's API.

