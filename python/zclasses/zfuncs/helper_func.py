from __future__ import print_function
from sys import stderr
import json

def pathToString(pathTP):
    lst = list(map(str,pathTP))
    #print(lst)
    return " -> ".join(lst)

def eprint(*args, **kwargs):
    print(*args, file=stderr, **kwargs)

def reFormatJSON(pyRes, keys = []):
    tmp = pyRes;

    if len(keys):
        tmp = {}
        for key in pyRes:
            print("{} in {} is {}".format(key, keys, key in keys))
            if key in keys:
                tmp[key] = pyRes[key];

    return json.dumps(tmp, sort_keys=True, indent=4)
