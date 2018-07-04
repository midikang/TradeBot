from sys import stdin
from zclasses.zfuncs.helper_func import eprint
from zclasses.zfuncs.pathDB import insertPath, insertCrossPlat, getMostRecentPid

eprint("reading paths in json_str")

pid = 1 + getMostRecentPid()

isFirstLine = True
for line in stdin:
    if isFirstLine:
        plat1,plat2 = line.split()
        isFirstLine = False
        continue


    eprint(line)
    insertPath(line) # the auto generated pid for line is same as the var pid here
    insertCrossPlat(plat1,plat2,pid)


    pid+=1 # the value of 'pid' is now greater that of the most recent line
