from zclasses.TradingPair import TradingPair
from zclasses.zfuncs.helper_func import eprint
import zclasses.zfuncs.translateDB as tDB

def getAllTPs(platform, validSymbols):
    ''' validSymbols are TPs in the string form, containing coins' aliases '''
    alias2int = tDB.getAlias2Int(platform)
    tradingPairs = []

    i = 0
    tot = len(validSymbols)
    for symbol in validSymbols:
        if not (i%100):
            eprint("{}\t{}/{}".format(platform,i,tot))
        i+=1


        aliasList = symbol2pl(platform, symbol, alias2int.keys())

        # translate the list of alias into list of integers
        intList = [ int(alias2int[aliasList[0]]),
                    int(alias2int[aliasList[1]]) ]

        if 0 in intList: # there exists a coin alias which dictionary doesn't know of
            continue


        tradingPairs.append( TradingPair(intList, symbol, platform) )
        intList.reverse()
        tradingPairs.append( TradingPair(intList, symbol, platform, isInverted = True) )

    #for i in range(0,len(tradingPairs),2): eprint(tradingPairs[i])
    return tradingPairs


def symbol2pl(plat, symbol, knownAliases):
    ''' func('bitfinex', "btc-ltc", [..])  ->  ["btc","ltc"]
        func('binance', "btcsc", [..])     ->  ["btc","sc"]
        func('poloniex', "btcsc", [..])    ->  ["sc", "btc"]
        func('bitfinex', "g-uafeji", [..])    ->  ["alias", "alias"]

        this function tries to recognize 2 coins' aliases in the given string symbol
        and returns a list consisting of the 2 aliases '''

    newSymbol = symbol.lower()
    delimiter = list(filter(lambda x: x in symbol,["-","_"," "]))
    if delimiter:  # remove the delimiter from the symbol if exists
        newSymbol = newSymbol.replace(delimiter[0],"")


    aliasList = ["alias","alias"]
    # this will work even if symbol contains aliases with variety of lengths
    for alias in knownAliases:
        if newSymbol.startswith(alias) and newSymbol[len(alias):] in knownAliases:
            aliasList = [newSymbol[:len(alias)], newSymbol[len(alias):]]
            break

    # special cases
    if (plat == "bitfinex"):
        pass

    elif (plat == "poloniex"):
        aliasList.reverse()

    elif (plat == "binance"):
        pass

    elif (plat == "yobit"):
        pass

    return aliasList
