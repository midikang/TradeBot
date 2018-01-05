from __future__ import print_function
from sys import stderr
import json

def eprint(*args, **kwargs):
    print(*args, file=stderr, **kwargs)

def reFormatPair(plat, pair):
    if (len(pair) == 6):
        tmp = [pair[:3], pair[3:]]

    elif ("_" in pair):
        tmp = pair.split("_")

    elif ("-" in pair):
        tmp = pair.split("-")

    else:
        # use dictionary to translate
        '''
        for c in dict:
            if pair startswith c:
                tmp = [pair[:len(c)], pair[len(c):]]
            elif pair endswith c:
                tmp = [pair[len(c):], pair[:len(c)]]
            else:
                print("dict knows nothing about: "+pair)
                exit()
        '''


    if (plat == "bitfinex"):
        pass;

    elif (plat == "poloniex"):
        tmp.reverse()

    elif (plat == "binance"):
        pass

    elif (plat == "yobit"):
        pass

    else:
        print('''
        ################# ERROR ####################################################
        ##  trying to reFormatPair: |{}| for unrecognized platform: {}
        ################# ERROR ####################################################
        '''.format(plat))
    return tmp

def reFormatJSON(pyRes, keys = []):
    tmp = pyRes;

    if len(keys):
        tmp = {}
        for key in pyRes:
            print("{} in {} is {}".format(key, keys, key in keys))
            if key in keys:
                tmp[key] = pyRes[key];

    return json.dumps(tmp, sort_keys=True, indent=4)
