from zclasses.zfuncs.helper_func import eprint
import sys

amt_arg = len(sys.argv)
if amt_arg != 3 and amt_arg != 5:
    eprint("Usage: python gen_double_plat_paths.py plat1 plat2 opt(amtTP amtTP)")
    eprint("\t\tamtTP defaults to 1")
    exit()

from zclasses.Generator import Generator
from zclasses.zfuncs.translateDB import getAliases, getAlias2Int
from zclasses.zfuncs.helper_func import json_encode
eprint("loading args")

plat1 = sys.argv[1]
plat2 = sys.argv[2]
amtTP1 = 1
amtTP2 = 1

if amt_arg == 5:
    amtTP1 = int(sys.argv[3])
    amtTP2 = int(sys.argv[4])

if plat1 == "test":
    plat1 = "poloniex"
    plat2 = "bitfinex"


eprint("setup genbot")
genBot  = Generator()

genBot.setupPlatsTPs(plat1)
genBot.setupPlatsTPs(plat2)

eprint("find overlapping coins")
platformAliases = [getAliases(plat1),getAliases(plat2)]
coinLists = [set(),set()] # set of int repr of coins in plat1 and plat2 respectively
alias2intDicts = [getAlias2Int(plat1),getAlias2Int(plat2)]

for i in range(2): # populate coinLists
    for a in platformAliases[i]:
        coinLists[i].add(int(alias2intDicts[i][a])) # int cast because the dict is {str:str}

overlappingCoins = coinLists[0].intersection(coinLists[1])
#eprint(overlappingCoins)

eprint("begin generating paths with max length {} coins across \nplatforms \t{} \tand \t{}\n\n".format(amtTP1+amtTP2,plat1,plat2))
print("{} {}".format(plat1,plat2))
for int in overlappingCoins:
    pathsPart1 = genBot.genPathsWithInt(plat1,amtTP1,endInt = int)

    for pathPart1 in pathsPart1:
        #eprint(pathPart1)
        if pathPart1[0].getHead() == int: # pathPart1 shouldn't form a loop by itself
            continue # avoid looking at these kind of paths

        #eprint("plat2:{}({})\namtTP2:{}({})\nstartInt:{}({})\nendInt:{}({})\n".format(plat2,type(plat2),amtTP2,type(amtTP2),int,type(int),pathPart1[0].getHead(),type(pathPart1[0].getHead())))
        pathsPart2 = genBot.genPathsWithInt(plat2,amtTP2,startInt = int,
                                            endInt = pathPart1[0].getHead())
        for pathPart2 in pathsPart2:
            fullPath = []
            for tp in pathPart1 + pathPart2:
                fullPath.append(tp.getJSON())

            print(json_encode(fullPath))
