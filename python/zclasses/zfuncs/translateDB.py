from zclasses.zfuncs.helper_func import sendReq

def getTranslateDBUrl():
    return "http://localhost/tradebot/php/translateDB.php?"

def getTranslateUrl(self, cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/translate.php?", cmdAndArgs)

def getPlatforms():
    return sendReq(getTranslateUrl() + "cmd=getPlatforms")

def getAliases(platform):
    return sendReq(getTranslateUrl('getAliases&platform={}'.format(platform)))

def getNameWithInt(self, int):
    url = getTranslateUrl('getNameWithInt&int={}'.format(int))
    #print(url)
    return sendReq(url)

def getIntWithName(self, name):
    url = getTranslateUrl('getIntWithName&name={}'.format(name))
    #print(url)
    return sendReq(url)

def getNameWithAlias(self, plat, alias):
    url = getTranslateUrl('getNameWithAlias&platform={}&alias={}'.format(plat,alias))
    #print(url)
    return sendReq(url)

def getAliasWithName(self, plat, name):
    url = getTranslateUrl('getAliasWithName&platform={}&name={}'.format(plat,name))
    #print(url)
    return sendReq(url)

def getAliasWithInt(self, plat, int):
    url = getTranslateUrl('getAliasWithInt&platform={}&int={}'.format(plat,int))
    #print(url)
    return sendReq(url)

def getIntWithAlias(self, plat, alias):
    url = getTranslateUrl('getIntWithAlias&platform={}&alias={}'.format(plat,alias))
    #print(url)
    return sendReq(url)
