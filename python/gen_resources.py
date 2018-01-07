from Trader import Trader
from helper_func import eprint
from tree_func import *
from tp_func import *
import sys
#from processes import findPaths

#print(sys.argv)
#exit()
platform = sys.argv[1]
amt = 0.04
#finexBot = Trader("bitfinex")
#poloniexBox = Trader("poloniex");
bot = Trader(platform)

onlinelist = bot.getValidPairs() # """
#onlinelist = "BCN-BTC<>BTC-ETH<>ETH-USDT<>USDT-ZEC<>ZEC-XMR<>XMR-USDT<>USDT-LTC<>LTC-XMR<>XMR-BCN".split("<>")
totalPairs = len(onlinelist)
print("totalPairs: "+str(totalPairs))

reducedList = onlinelist[:totalPairs]

#print("reducedList:\n"+str(reducedList))
#print("onlinelist:\n"+str(onlinelist))
#exit()
nodelist = getAllTPs(platform, reducedList)
#for p in nodelist:    print(p)
#print(len(nodelist))
#exit()

i=0
for r in nodelist:#[7:8]:
    i += 1
    rootPair = r
    eprint("{}\t\t {}/{}".format(r, i, len(nodelist)))

    populateTree(nodelist, rootPair)
    #print(len(rootPair.getChildren()))
    #continue
#exit()
    #'''
    allPaths = treeToList(rootPair)
    for path in allPaths:
        print(str(len(path)-1)+"steps", end='')
        for p in path:
            print(p, end='')
        print() # '''

    treeStr, pathStats = getTreeStats(rootPair)
    #print(treeStr)
    print(pathStats)
