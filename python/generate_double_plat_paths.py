from zclasses.zfuncs.helper_func import eprint

import sys
if len(sys.argv) != 3:
    eprint("Usage: python gen_double_plat_paths.py plat1 plat2")
    exit()

from zclasses.Generator import Generator
from zclasses.Translator import Translator
from zclasses.zfuncs.tp_func import getAllTPs
from zclasses.zfuncs.helper_func import pathToString

plat1 = sys.argv[1]
plat2 = sys.argv[2]

dictBot = Translator()
genBot  = Generator()
#eprint(platform)
if plat1 == "test":
    plat1 = "poloniex"
    plat2 = "bitfinex"
    plat1list = ["btcusd","xrpltc","ethusd","ethxrp","zeceth","zecbtc"]
    plat2list = ["usd-btc","btc-xrp","eth-xrp","123-456","ltc-btc"]
else:
    genBot.setPlatform(plat1)
    plat1list = genBot.getValidPairs()

    genBot.setPlatform(plat2)
    plat2list = genBot.getValidPairs()


platformTPs = [getAllTPs(plat1, plat1list, dictBot),getAllTPs(plat2, plat2list, dictBot)]
coinLists = [set(),set()] # set of int repr of coins in plat1 and plat2 respectively

for i in range(2): # populate coinLists
    for tp in platformTPs[i]:
        coinLists[i].add(tp.getHead())
        coinLists[i].add(tp.getTail())

overlappingCoins = coinLists[0].intersection(coinLists[1])

for int in overlappingCoins:
    pathsPart1 = genBot.genPathsWithInt(plat1,2,endInt = int)

    for pathPart1 in pathsPart1:
        pathsPart2 = genBot.genPathsWithInt(plat2,2,startInt = int,
                                            endInt = pathPart1[0].getHead())
        for pathPart2 in pathsPart2:
            fullPath = pathPart1 + pathPart2
            # the length of a path is determined by amount of diff coins involved
            # since the pair of coins in each TP in the path is unique
            # therefore amount of diff coins involved in the path is amt(TP)-1
            print("\n{},{}\n".format(len(fullPath)-1,pathToString(fullPath)))
