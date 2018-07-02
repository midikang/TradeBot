from sys import stdin
from zclasses.zfuncs.helper_func import eprint
from zclasses.zfuncs.pathDB import insertPath, insertCrossPlat, getMostRecentPid

eprint("reading paths in json_str")

if len(stdin) <= 1:
    eprint("only given one line via stdin:\n")
    exit()

pid = 1 + getMostRecentPid()
plat1,plat2 = stdin[0].split()

for line in stdin[1:]:
    insertCrossPlat(plat1,plat2,pid)
    eprint(line)
    insertPath(line) # the auto generated pid for line is pid


    pid+=1 # the value of 'pid' is now greater that of the most recent line
