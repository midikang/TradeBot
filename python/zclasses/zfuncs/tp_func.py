from zclasses.TradingPair import TradingPair
from zclasses.zfuncs.helper_func import eprint
import zclasses.zfuncs.translateDB as tDB

def getAllTPs(platform, validSymbols):
    ''' validSymbols are TPs in the string form, containing coins' aliases '''
    i = 0
    tot = len(validSymbols)

    tradingPairs = []
    for symbol in validSymbols:
        i+=1
        if not (i%200):
            eprint("{}\t{}/{}".format(platform,i,tot))
            

        pl = symbol2pl(platform, symbol, tDB.getAliases(platform))

        if 0 in pl: # there exists a coin alias which tDB doesn't know of
            continue


        tradingPairs.append( TradingPair(pl, symbol, platform) )
        pl.reverse()
        tradingPairs.append( TradingPair(pl, symbol, platform, isInverted = True) )

    return tradingPairs


def symbol2pl(plat, symbol, allRecognizedAliases):
    ''' func('bitfinex', "btc-ltc", [..])  ->  ( ["btc","ltc"] )  [int,int]
        func('binance', "btcsc", [..])     ->  ( ["btc","sc"] )   [int,int]
        func('poloniex', "btcsc", [..])    ->  ( ["sc", "btc"] )  [int,int]

        this function tries to recognize 2 coins' aliases and return the symbol
        in list as a pair of int_repr '''

    symbol = symbol.lower()
    delimiter = list(filter(lambda x: x in symbol,["-","_"," "]))
    if delimiter:
        aliasList = symbol.split(delimiter[0])

    else: # if no clear delimiter, use tDB to try to recognize coins
        unknown = True

        for alias in allRecognizedAliases:
            if symbol.startswith(alias) and symbol[len(alias):] in allRecognizedAliases:
                aliasList = [symbol[:len(alias)], symbol[len(alias):]]
                unknown = False
                break

        #"""
        if unknown:
            return [0,0]


            #mid = len(symbol)//2
            #aliasList = [symbol[:mid], symbol[mid:]]
            #eprint("symbol2pl:\t\t|{}| not recognized. \nUpdate {} dict accordingly\n".format(symbol, plat))
        #"""

    # translate the list of alias into list of integers
    intList = [ tDB.getIntWithAlias(plat,aliasList[0]),
                tDB.getIntWithAlias(plat,aliasList[1])]


    if (plat == "bitfinex"):
        pass

    elif (plat == "poloniex"):
        aliasList.reverse()

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

    return intList
