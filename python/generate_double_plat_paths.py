from zclasses.zfuncs.helper_func import eprint
import sys

amt_arg = len(sys.argv)
if amt_arg != 3 and amt_arg != 5:
    eprint("Usage: python gen_double_plat_paths.py plat1 plat2 opt(amtTP amtTP)")
    eprint("\t\tamtTP defaults to 1")
    exit()

from zclasses.Generator import Generator
from zclasses.Translator import Translator
from zclasses.zfuncs.tp_func import getAllTPs
from zclasses.zfuncs.helper_func import pathToString

plat1 = sys.argv[1]
plat2 = sys.argv[2]
amtTP1 = 1
amtTP2 = 1

if amt_arg == 5:
    amtTP1 = sys.argv[3]
    amtTP2 = sys.argv[4]

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

print("generating paths with max length {} coins across \nplatforms \t{} \tand \t{}".format(amtTP1+amtTP2,plat1,plat2))
for int in overlappingCoins:
    pathsPart1 = genBot.genPathsWithInt(plat1,amtTP1,endInt = int)

    for pathPart1 in pathsPart1:
        if pathPart1[0].getHead() == int: # pathPart1 shouldn't form a loop by itself
            continue # avoid looking at these kind of paths


        pathsPart2 = genBot.genPathsWithInt(plat2,amtTP2,startInt = int,
                                            endInt = pathPart1[0].getHead())
        for pathPart2 in pathsPart2:
            fullPath = pathPart1 + pathPart2
            # the length of a path is determined by amount of diff coins involved

            print("\n{},{}\n".format(len(fullPath),pathToString(fullPath)))
