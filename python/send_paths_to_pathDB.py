from sys import stdin
from zclasses.zfuncs.helper_func import eprint
from zclasses.zfuncs.pathDB import insertPath

eprint("reading paths in json_str")

isFirstLine = True
for line in stdin:
    if isFirstLine:
        plat1,plat2 = line.split()
        isFirstLine = False
        continue


    eprint(line)
    insertPath(plat1,plat2,line)
