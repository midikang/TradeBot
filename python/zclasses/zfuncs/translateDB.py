from zclasses.zfuncs.helper_func import sendReceiveReq

def getTranslateDBUrl():
    return "http://localhost/tradebot/php/translateDB.php?"

def getTranslateUrl():
    return "http://localhost/tradebot/php/translate.php?"

def getPlatforms():
    return sendReceiveReq(getTranslateDBUrl(),gdata={"cmd":"getPlatforms"})

def getFullDict():
    return sendReceiveReq(getTranslateDBUrl(),gdata={"cmd":"getFullDictionary"})

def getAliases(platform):
    return sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getAliases","platform":platform})

def getAlias2Int(platform):
    return sendReceiveReq(getTranslateDBUrl(),gdata={"cmd":"getAlias2Int","platform":platform})

def getNameWithInt(int):
    return sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getNameWithInt","int":int})

def getIntWithName(name):
    return int(sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getIntWithName","name":name}))

def getNameWithAlias(plat, alias):
    return sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getNameWithAlias","platform":plat,"alias":alias})

def getAliasWithName(plat, name):
    return sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getAliasWithName","platform":plat,"name":name})

def getAliasWithInt(plat, int):
    return sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getAliasWithInt","platform":plat,"int":int})

def getIntWithAlias(plat, alias):
    return int(sendReceiveReq(getTranslateUrl(),gdata={"cmd":"getIntWithAlias","platform":plat,"alias":alias}))
