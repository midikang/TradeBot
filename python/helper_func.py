import json

def reFormatPair(plat, pair):
    if (plat == "bitfinex"):
        tmp = [pair[:3], pair[3:]]

    elif (plat == "poloniex"):
        tmp = pair.split("_")
        tmp.reverse()

    elif (plat == "binance"):
        tmp = pair.split("_")

    elif (plat == "yobit"):
        tmp = pair.split("_")

    else:
        print('''
        ################# ERROR #########################################
        ##  trying to reFormatPair for unrecognized platform: {}
        ################# ERROR #########################################
        '''.format(plat))
    return tmp

def reFormatJSON(pyRes, keys):
    tmp = {};
    for key in pyRes:
        if (key in keys):
            tmp[key] = pyRes[key];

    return json.dumps(tmp, sort_keys=True, indent=4)
