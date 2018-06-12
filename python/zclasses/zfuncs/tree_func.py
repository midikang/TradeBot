def treeToList(rootNode):
    ''' rootNode is the root of the tree
        returns a list containing all branches,
                where each branch is a list containing TradingPairs'''
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
    leaves["start"] = str(rootNode)
    return treeStr, leaves


def populateTree(tradingPairs, rootNode, maxDepth, leaf):
    ''' populateTree([TradingPairs], TradingPair) -> rootNode
        this tree only contains branches with leaves leaf '''

    def recurse(crNode, visitedNodes, crDepth):
        ''' determines whether the crNode will lead to forming a valid path
            within maxDepth tree depth (excluding root) '''

        if crDepth == maxDepth:
            return False

        if crNode.getTail() == leaf: # crNode leads back to firstCoin
            return True

        visitedNodes.add(crNode.getTail())
        nextNodes = list(filter( lambda x: crNode.comesBefore(x) and
                                            x.getTail() not in visitedNodes
                                            , tradingPairs ))

        #print("{}->{}kids".format(crNode, len(nextNodes)) )
        #for p in nextNodes: print(p, end="")
        #print

        for nextNode in nextNodes:
            child = nextNode.duplicate()
            if recurse( child, set(visitedNodes), crDepth+1): # make a copy of visitedNodes
                crNode.addChild(child) # only add pairs that leads to forming a path

        # crNode leads to forming a path => prevNode should adopt crNode as child
        return len(crNode.getChildren())


    recurse(rootNode, set(), 0)
