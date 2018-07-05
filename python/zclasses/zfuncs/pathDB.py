from zclasses.zfuncs.helper_func import sendReq, sendReceiveReq

def getPathDBUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/pathDB.php?",cmdAndArgs)

def getPathUrl(cmdAndArgs):
    return "{}cmd={}".format("http://localhost/tradebot/php/path.php?", cmdAndArgs)

def insertPath(plat1,plat2path_jsonStr): #
    sendReq(getPathUrl('insertPath&plat1={}&plat2={}&path_jsonStr={}'.format(plat1,plat2,path_jsonStr)))

def selectPaths(plat1,plat2):
    return sendReceiveReq(getPathDBUrl('selectPaths&plat1{}&plat2={}'.format(plat1,plat2)))

def deletePath(pid): #
    sendReq(getPathUrl('deletePath&pid={}'.format(pid))

"""     The following functions may not be used here, but it will be implemented regardless for now
def isValidUser(uid,pw):
    return sendReceiveReq(getPathDBUrl('isValidUser&uid={}&pw={}'.format(uid,pw)))

def insertMonitor(uid,pid):
    sendReq(getPathUrl('insertMonitor&uid={}&pid={}'.format(uid,pid))

def insertUser(uid,pw): # may not be used
    sendReq(getPathUrl('insertMonitor&uid={}&pid={}'.format(uid,pid))

def deleteMonitor(uid,pid):
    sendReq(getPathUrl('deleteMonitor&uid={}&pid={}'.format(uid,pid))

def deleteUser(uid,pw): # may not be used
    sendReq(getPathUrl('deleteMonitor&uid={}&pid={}'.format(uid,pid))
"""
