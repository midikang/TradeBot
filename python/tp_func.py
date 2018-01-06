from TradingPair import TradingPair

def validTradingPairs(platform, validSymbols):
    # cannot utilize symbol2TP because of fear of platforms like poloniex, where their symbols are swapped
    tradingPairs = []
    for symbol in validSymbols:
        pairLst = reFormatPair(platform, symbol)
        tradingPairs.append( TradingPair(pairLst, symbol, platform) )
        pairLst.reverse()
        tradingPairs.append( TradingPair(pairLst, symbol, platform, True) )

    return tradingPairs

def symbol2TP(platform, symbol, validTPs):
    ''' validTPs is a set of all valid symbols in string '''
    pairLst = reFormatPair(platform, symbol)

    return TradingPair(pairLst, symbol, platform, symbol not in validTPs)

def reFormatPair(plat, symbol):
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
        pass;

    elif (plat == "poloniex"):
        tmp.reverse()

    elif (plat == "binance"):
        pass

    elif (plat == "yobit"):
        pass

    else:
        print('''
        ################# ERROR ####################################################
        ##  trying to reFormatPair: |{}| for unrecognized platform: {}
        ################# ERROR ####################################################
        '''.format(plat))
    return tmp
