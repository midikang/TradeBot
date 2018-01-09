import json

class TradingPair:
    ''' contains information about a pair of coins that will help with
        algorithms in process.py'''

    def __init__(self, pairLst, symbol = "", platform = "", isInverted = False):
        ''' pairLst must contain two items, names (not aliases) of 2 coins
            i.e. they must have gone thr the translation process so now
            what they're called should no longer be platform specific'''

        self.__platform = platform
        self.__children = []
        self.__parent = None
        self.__symbol = symbol
        self.__head = pairLst[0] # this denotes the "coin"
        self.__tail = pairLst[1] # this denotes the "currency"

        self.__isInverted = isInverted

    def duplicate(self):
        ''' returns a duplicate of self except no children or parent '''
        return TradingPair([self.__head,self.__tail], self.__symbol, self.__platform, self.__isInverted)

    def getPlatform(self):
        return self.__platform

    def isInverted(self):
        return self.__isInverted

    def getSymbol(self):
        return self.__symbol

    def getHead(self):
        return self.__head

    def getTail(self):
        return self.__tail

    def comesBefore(self, other):
        ''' other is of type TradingPair
            returns whether other connects to tail of self like dominoes '''
        return self.__tail == other.getHead()

    def rmChild(self, child):
        #print("{} appending {}".format(self, child));
        if child in self.__children:
            self.__children.remove(child)

        else:
            pass
            #throw error

    def addChild(self, child):
        #print("{} appending {}".format(self, child));
        if child not in self.__children:
            self.__children.append(child)
            child.setParent(self)

    def getChildren(self):
        return self.__children

    def setParent(self, parent):
        self.__parent = parent

    def rmParent(self):
        self.__parent = None

    def getParent(self):
        return self.__parent

    def __str__(self):
        return '<>{}-{}'.format(self.__head, self.__tail)

    def nodeStr(self, level = 0):
        string = "{}{}. {} -> {}\n".format("\t" * level, level, str(self), len(self.__children))

        for c in self.__children:
            string += c.nodeStr(level + 1) + "\n"

        return string[:-1]

    def __eq__(self, other):
        return str(self) == str(other)
        #return self.__symbol == other.getSymbol()
