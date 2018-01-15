from zfuncs.helper_func import eprint
import sys
if len(sys.argv) != 3:
    eprint("Usage: python gen_double_plat_paths.py plat1 plat2")
    exit()

from zclasses.Trader import Trader
from zfuncs.tp_func import getAllTPs

plat1 = sys.argv[1]
plat2 = sys.argv[2]
#eprint(platform)
if plat1 == "test":
    plat1 = "bitfinex"
    plat2 = "bitfinex"
    plat1list = ["btc-usd","xrp-ltc","eth-usd","eth-xrp","zec-eth","zec-btc"]
    plat2list = ["usd-btc","btc-xrp","eth-xrp","123-456","ltc-btc"]
else:
    bot1 = Trader(plat1)
    bot2 = Trader(plat2)
    plat1list = bot1.getValidPairs()
    plat2list = bot2.getValidPairs()


p1TPs = getAllTPs(plat1, plat1list)
p2TPs = getAllTPs(plat2, plat2list)

p2PSs = set(map(str, p2TPs))

existingSymbols = set()
for p1TP in p1TPs:
    p1PS = str(p1TP)

    # print("\t"+p1TP.getSymbol())
    # print("\t"+str(existingSymbols))
    if p1TP.getSymbol() in existingSymbols:
        continue

    if p1PS in p2PSs:
        print("{}".format(p1PS))
        existingSymbols.add(p1TP.getSymbol())
