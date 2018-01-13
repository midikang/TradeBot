from zclasses.TradingPair import TradingPair

def getAllTPs(platform, validSymbols):
    tradingPairs = []
    for symbol in validSymbols:
        pl = symbol2pl(platform, symbol)
        tradingPairs.append( TradingPair(pl) )
        pl.reverse()
        tradingPairs.append( TradingPair(pl, isInverted = True) )

    return tradingPairs

def ps2TP(plat, ps, validpsSet):
    ''' pl2TP(poloniex, ["btc-ltc"], ["btc-ltc"]) -> TP([btc,ltc], not inverted)
        pl2TP(poloniex, ["ltc-btc"], ["btc-ltc") -> TP([btc,ltc], inverted)

        validpsSet is a set where each item is a ps'''

    return TradingPair(ps.split("-"), platform = plat, isInverted = ps not in validpsSet)

def symbol2pl(plat, symbol):
    ''' func(bitfinex, btc-ltc) ->  [btc,ltc] '''
    symbol = symbol.lower()
    delimiter = list(filter(lambda x: x in symbol,["-","_"," "]))
    if delimiter:
        tmp = symbol.split(delimiter[0])

    elif (len(symbol) == 6):
        tmp = [symbol[:3], symbol[3:]]

    else:
        # use dictionary to translate
        '''
        coinDict()
        for c in dict:
            if symbol startswith c:
                tmp = [symbol[:len(c)], symbol[len(c):]]
            elif symbol endswith c:
                tmp = [symbol[len(c):], symbol[:len(c)]]
            else: # not anything we know in coinDict
                mid = len(symbol)//2
                tmp = [symbol[:mid], symbol[mid:]]
                eprint("dict knows nothing about: "+symbol)
                #exit()
        '''

    if (plat == "bitfinex"):
        pass

    elif (plat == "poloniex"):
        tmp.reverse()

    elif (plat == "binance"):
        pass

    elif (plat == "yobit"):
        pass

    else:
        print('''
        ################# ERROR ####################################################
        ##  trying to process: |{}| for unrecognized platform: {}
        ################# ERROR ####################################################
        '''.format(tmp, plat))
        exit()
    return tmp
