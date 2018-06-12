from zclasses.TradingPair import TradingPair
from zclasses.zfuncs.helper_func import eprint

def printPathTP(pathTP):
    lst = list(map(str,pathTP))
    print(lst)
    return " -> ".join(lst)

def getAllTPs(platform, validSymbols, dictBot):
    ''' validSymbols are TPs in the string form, containing coins' aliases '''

    tradingPairs = []
    for symbol in validSymbols:
        pl = symbol2pl(platform, symbol, dictBot)

        if 0 in pl: # there exists a coin alias which dictBot doesn't know of
            continue


        tradingPairs.append( TradingPair(pl, symbol, platform) )
        pl.reverse()
        tradingPairs.append( TradingPair(pl, symbol, platform, isInverted = True) )

    return tradingPairs

"""
def ps2TP(plat, ps, validpsSet): # not sure if actually useful
    ''' pl2TP(poloniex, ["btc-ltc"], ["btc-ltc"]) -> TP([btc,ltc], not inverted)
        pl2TP(poloniex, ["ltc-btc"], ["btc-ltc") -> TP([btc,ltc], inverted)

        validpsSet is a set where each item is a ps'''

    return TradingPair(ps.split("-"), platform = plat, isInverted = ps not in validpsSet)
"""

def symbol2pl(plat, symbol, dictBot):
    ''' func('bitfinex', "btc-ltc",db)  ->  ( ["btc","ltc"] )  [int,int]
        func('binance', "btcsc",db)     ->  ( ["btc","sc"] )   [int,int]
        func('binance', "btcsc",db)     ->  ( ["btc","sc"] )   [int,int]

        this function tries to recognize 2 coins' aliases and return the symbol
        in list form with the coins' alias in their int repr '''

    symbol = symbol.lower()
    delimiter = list(filter(lambda x: x in symbol,["-","_"," "]))
    if delimiter:
        aliasList = symbol.split(delimiter[0])

    else: # if no clear delimiter, use dictBot to try to recognize coins
        allRecognizedAliases = dictBot.getDict(plat).getAliasDict().keys()
        #eprint(allRecognizedAliases)

        # for debug
        unknown = True

        for alias in allRecognizedAliases:
            if symbol.startswith(alias) and symbol[len(alias):] in allRecognizedAliases:
                aliasList = [symbol[:len(alias)], symbol[len(alias):]]
                unknown = False
                break

        # it's not anything we recognize, do best guess
        if unknown:
            mid = len(symbol)//2
            aliasList = [symbol[:mid], symbol[mid:]]
            eprint("symbol2pl:\t\t|{}| not recognized. \nUpdate {} dict accordingly\n".format(symbol, plat))


    # translate the list of alias into list of integers
    intList = [ dictBot.getIntWithAlias(plat,aliasList[0]),
                dictBot.getIntWithAlias(plat,aliasList[1])]


    if (plat == "bitfinex"):
        pass

    elif (plat == "poloniex"):
        aliasList.reverse()

    elif (plat == "binance"):
        pass

    elif (plat == "yobit"):
        pass

    elif (plat == "zb"):
        pass

    else:
        print('''
        ################# ERROR ####################################################
        ##  trying to process: |{}| for unrecognized platform: {}
        ################# ERROR ####################################################
        '''.format(tmp, plat))
        exit()

    return intList
