from sys import stdin
from zclasses.zfuncs.helper_func import eprint
from zclasses.zfuncs.pathDB import insertPath

eprint("reading paths in json_str")

for line in stdin:
    eprint(line)
    insertPath(line)
