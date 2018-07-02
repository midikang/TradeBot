from zclasses.zfuncs.helper_func import sendReq, sendReceiveReq

def getPathDBUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/pathDB.php?",cmdAndArgs)

def getPathUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/path.php?", cmdAndArgs)

def selectPath(uid):
    return sendReceiveReq(getPathDBUrl('selectPath&uid={}'.format(uid)))

def insertPath(path_jsonStr): #
    sendReq(getPathUrl('insertPath&path_jsonStr={}'.format(path_jsonStr)))

def insertCrossPlat(plat1,plat2,pid): #
    sendReq(getPathUrl('insertCrossPlat&plat1={}&plat2={}&pid={}'.format(plat1,plat2,pid)))

def getMostRecentPid():
    return sendReceiveReq(getPathDBUrl('getMostRecentPid'))

"""     The following functions may not be used here, but it will be implemented regardless
def isValidUser(uid,pw):
    return sendReceiveReq(getPathDBUrl('isValidUser&uid={}&pw={}'.format(uid,pw)))

def insertMonitor(uid,pid):
    sendReq(getPathUrl('insertMonitor&uid={}&pid={}'.format(uid,pid))

def insertUser(uid,pw): # may not be used
    sendReq(getPathUrl('insertMonitor&uid={}&pid={}'.format(uid,pid))

def deleteMonitor(uid,pid):
    sendReq(getPathUrl('deleteMonitor&uid={}&pid={}'.format(uid,pid))

def deletePath(pid): #
    sendReq(getPathUrl('deletePath&pid={}'.format(pid))

def deleteUser(uid,pw): # may not be used
    sendReq(getPathUrl('deleteMonitor&uid={}&pid={}'.format(uid,pid))
"""
