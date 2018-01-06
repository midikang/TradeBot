from __future__ import print_function
from sys import stderr
import json

def eprint(*args, **kwargs):
    print(*args, file=stderr, **kwargs)

def reFormatPair(plat, pair):
    delimiter = list(filter(lambda x: x in pair,["-","_"," "]))
    if delimiter:
        tmp = pair.split(delimiter[0])

    elif (len(pair) == 6):
        tmp = [pair[:3], pair[3:]]

    else:
        # use dictionary to translate
        '''
        coinDict()
        for c in dict:
            if pair startswith c:
                tmp = [pair[:len(c)], pair[len(c):]]
            elif pair endswith c:
                tmp = [pair[len(c):], pair[:len(c)]]
            else: # not anything we know in coinDict
                mid = len(pair)//2
                tmp = [pair[:mid], pair[mid:]]
                eprint("dict knows nothing about: "+pair)
                #exit()
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
