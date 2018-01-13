from zfuncs.helper_func import eprint
import sys
if len(sys.argv) != 2:
    eprint("Usage: python gen_resources.py platform (opt: redirect to resources/platform/all_paths.txt)")
    exit()
elif sys.argv[1] == "help" :
    eprint("Usage: python gen_resources.py platform (opt: redirect to resources/platform/all_paths.txt)")
    exit()

from zclasses.Trader import Trader
from zfuncs.tree_func import getTreeStats, populateTree, treeToList
from zfuncs.tp_func import getAllTPs

platform = sys.argv[1]
#eprint(platform)
if platform == "test":
    platform = "bitfinex"
    onlinelist = ["btc-usd","btc-xrp","eth-usd","eth-xrp","zec-eth","zec-btc"]
else:
    bot = Trader(platform)
    onlinelist = bot.getValidPairs()


totalPairs = len(onlinelist)
#print("totalPairs: "+str(totalPairs))

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
