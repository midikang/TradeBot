from zclasses.zfuncs.helper_func import sendReq, sendReceiveReq

def getPathDBUrl():
    return "http://localhost/tradebot/php/pathDB.php?"

def getPathUrl():
    return "http://localhost/tradebot/php/path.php?"

def selectUsers():
    return sendReceiveReq(getPathDBUrl(),data={"cmd":,"selectUsers"})

def selectMonitors(user):
    return sendReceiveReq(getPathDBUrl(),method="post",data = {"user":user, "cmd":"selectMonitors"})

def insertPath(plat1,plat2,path_jsonStr): #
    sendReq(getPathUrl(),data = {"cmd":"insertPath", "plat1":plat1, "plat2":plat2, "path_jsonStr":path_jsonStr})

def selectPaths(plat1,plat2):
    return sendReceiveReq(getPathDBUrl(),'selectPaths&plat1{}&plat2={}'.format(plat1,plat2)))

def deletePath(pid): #
    sendReq(getPathUrl('deletePath&pid={}'.format(pid)))

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
