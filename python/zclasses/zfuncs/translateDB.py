from zclasses.zfuncs.helper_func import sendReq

def getTranslateDBUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/translateDB.php?",cmdAndArgs)

def getTranslateUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/translate.php?", cmdAndArgs)

def getPlatforms():
    return sendReq(getTranslateDBUrl("getPlatforms"))

def getAliases(platform):
    return sendReq(getTranslateUrl('getAliases&platform={}'.format(platform)))

def getNameWithInt(int):
    url = getTranslateUrl('getNameWithInt&int={}'.format(int))
    #print(url)
    return sendReq(url)

def getIntWithName(name):
    url = getTranslateUrl('getIntWithName&name={}'.format(name))
    #print(url)
    return int(sendReq(url))

def getNameWithAlias(plat, alias):
    url = getTranslateUrl('getNameWithAlias&platform={}&alias={}'.format(plat,alias))
    #print(url)
    return sendReq(url)

def getAliasWithName(plat, name):
    url = getTranslateUrl('getAliasWithName&platform={}&name={}'.format(plat,name))
    #print(url)
    return sendReq(url)

def getAliasWithInt(plat, int):
    url = getTranslateUrl('getAliasWithInt&platform={}&int={}'.format(plat,int))
    #print(url)
    return sendReq(url)

def getIntWithAlias(plat, alias):
    url = getTranslateUrl('getIntWithAlias&platform={}&alias={}'.format(plat,alias))
    #print(url)
    return int(sendReq(url))
