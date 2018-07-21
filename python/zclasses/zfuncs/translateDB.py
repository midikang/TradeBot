from zclasses.zfuncs.helper_func import sendReceiveReq

def getTranslateDBUrl():
    return "http://localhost/tradebot/php/translateDB.php?"

def getTranslateUrl():
    return "http://localhost/tradebot/php/translate.php?"

def getPlatforms():
    return sendReceiveReq(getTranslateDBUrl(),data={"cmd":"getPlatforms"})

def getAliases(platform):
    return sendReceiveReq(getTranslateUrl(),data={"cmd":"getAliases","platform":platform})

def getAlias2Int(platform):
    return sendReceiveReq(getTranslateDBUrl(),data={"cmd":"getAlias2Int","platform":platform})

def getNameWithInt(int):
    return sendReceiveReq(getTranslateUrl(),data={"cmd":"getNameWithInt","int":int})

def getIntWithName(name):
    return int(sendReceiveReq(getTranslateUrl(),data={"cmd":"getIntWithName","name":name}))

def getNameWithAlias(plat, alias):
    return sendReceiveReq(getTranslateUrl(),data={"cmd":"getNameWithAlias","platform":plat,"alias":alias})

def getAliasWithName(plat, name):
    return sendReceiveReq(getTranslateUrl(),data={"cmd":"getAliasWithName","platform":plat,"name":name})

def getAliasWithInt(plat, int):
    return sendReceiveReq(getTranslateUrl(),data={"cmd":"getAliasWithInt","platform":plat,"int":int})

def getIntWithAlias(plat, alias):
    return int(sendReceiveReq(getTranslateUrl(),data={"cmd":"getIntWithAlias","platform":plat,"alias":alias}))
