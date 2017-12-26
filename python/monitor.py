from Trader import Trader
import time
import datetime

platform = "poloniex"
coin = "xpm"
currency = "btc"
#finexBot = Trader("bitfinex")

bot = Trader("poloniex")

rate = 10
startTime = round(time.time())


timeStr = datetime.datetime.fromtimestamp(startTime).strftime('%Y-%m-%d %H:%M:%S')
print('''\t{}: {}-{}\t{}\n{}\n'''.format(platform, coin, currency, timeStr,bot.getCoinInfo(coin, currency)))

while(1):
	crTime = round(time.time())
	diff = crTime - startTime
	if (diff > 0 and diff%rate == 0): # every rate seconds
		timeStr = datetime.datetime.fromtimestamp(crTime).strftime('%Y-%m-%d %H:%M:%S')
		print('''\t{}: {}-{}\t{}\n{}\n'''.format(platform, coin, currency, timeStr,bot.getCoinInfo(coin, currency)))

		startTime = crTime
