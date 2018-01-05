from TradingPair import TradingPair
from helper_func import reFormatPair

def treeToList(rootNode):
    ''' rootNode is the root of the tree
        returns a list containing all branches, where each branch is a list'''
    branchList = []

    def populateBranchList(node, branch = []):
        kids = node.getChildren()

        branch.append(node)
        if len(kids) == 0: # reached leaf
            branchList.append(branch)
        else:
            for k in kids:
                populateBranchList(k, list(branch))

    populateBranchList(rootNode)
    return branchList


def getTreeStats(rootNode):
    ''' return info on the amount of leaves, amount of branches of diff lengths,
        and the str repr of the tree itself '''
    treeStr = rootNode.nodeStr()

    lines = treeStr.split("\n")

    leaves = {}
    totalLeaves = 0
    for line in lines:
        linelist = line.split()
        #print(linelist)
        if linelist[-1] == "0": # found a leaf
            totalLeaves += 1

            dictKey = linelist[0]+"steps"
            if dictKey in leaves:
                leaves[dictKey] += 1

            else:
                leaves[dictKey] = 1

    leaves["total"] = totalLeaves
    return treeStr, leaves

def validTradingPairs(platform, validSymbols):
    tradingPairs = []
    for symbol in validSymbols:
        pairLst = reFormatPair(platform, symbol)
        tradingPairs.append( TradingPair(pairLst, symbol, platform) )
        pairLst.reverse()
        tradingPairs.append( TradingPair(pairLst, symbol, platform, True) )

    return tradingPairs

def populateTree(tradingPairs, rootPair):
    ''' populateTree([TradingPairs], TradingPair) -> rootPair'''
    firstCoin = rootPair.getHead()

    def recurse(crNode, visitedNodes = set(), visitedPaths = set()):
        '''determines whether the crNode will lead to forming a valid path'''
        if crNode.getTail() == firstCoin: # crNode leads back to firstCoin
            return True

        visitedPaths.add(crNode.getSymbol())
        visitedNodes.add(crNode.getTail())
        nextNodes = list(filter( lambda x: crNode.comesBefore(x) and
                                            not x.getTail() in visitedNodes
                                            and
                                            not x.getSymbol() in visitedPaths
                                            , tradingPairs ))

        for nextNode in nextNodes:
            if recurse( nextNode, set(visitedNodes), set(visitedPaths) ): # make a copy of visitedCoins
                crNode.addChild(nextNode) # only add pairs that leads to forming a path

        # crNode leads to forming a path => prevNode should adopt crNode as child
        return len(crNode.getChildren())

    recurse(rootPair)
    #recurse(rootPair, {rootPair.getTail()}, {rootPair.getSymbol()} )

    return rootPair
