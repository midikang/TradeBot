from __future__ import print_function
from sys import stderr

import requests
import json
from lxml import html

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

def sendReq(url):
    #print(url+"\n")
    
    response = requests.get(url)

    # .content gives the response in bytes
    tree = html.fromstring(response.content)
    #print(response.text)

    jsonResStr = tree.xpath('//a[@class="json_response"]/text()')[0] # there's only 1 item in the returned list from xpath
    #print(jsonResStr)

    return json.loads(jsonResStr) # response as python obj
