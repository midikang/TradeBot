from zclasses.zfuncs.helper_func import sendReceiveReq

def getTranslateDBUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/translateDB.php?",cmdAndArgs)

def getTranslateUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/translate.php?", cmdAndArgs)

def getPlatforms():
    return sendReceiveReq(getTranslateDBUrl("getPlatforms"))

def getAliases(platform):
    return sendReceiveReq(getTranslateUrl('getAliases&platform={}'.format(platform)))

def getAlias2Int(platform):
    return sendReceiveReq(getTranslateDBUrl("getAlias2Int&platform={}".format(platform)))

def getNameWithInt(int):
    url = getTranslateUrl('getNameWithInt&int={}'.format(int))
    #print(url)
    return sendReceiveReq(url)

def getIntWithName(name):
    url = getTranslateUrl('getIntWithName&name={}'.format(name))
    #print(url)
    return int(sendReceiveReq(url))

def getNameWithAlias(plat, alias):
    url = getTranslateUrl('getNameWithAlias&platform={}&alias={}'.format(plat,alias))
    #print(url)
    return sendReceiveReq(url)

def getAliasWithName(plat, name):
    url = getTranslateUrl('getAliasWithName&platform={}&name={}'.format(plat,name))
    #print(url)
    return sendReceiveReq(url)

def getAliasWithInt(plat, int):
    url = getTranslateUrl('getAliasWithInt&platform={}&int={}'.format(plat,int))
    #print(url)
    return sendReceiveReq(url)

def getIntWithAlias(plat, alias):
    url = getTranslateUrl('getIntWithAlias&platform={}&alias={}'.format(plat,alias))
    #print(url)
    return int(sendReceiveReq(url))
