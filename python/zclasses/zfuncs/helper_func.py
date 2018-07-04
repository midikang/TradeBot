from __future__ import print_function
from sys import stderr

import requests
from json import dumps,loads

def eprint(*args, **kwargs):
    print(*args, file=stderr, **kwargs)

def json_encode(json_obj): # rename
    return dumps(json_obj)

def json_decode(json_str): # rename
    return loads(json_str)

def sendReceiveReq(url):
    """ sends and loads a json response from the given url,
        url corresponds to a local php script stored on the server,
        all such php scripts will only return objects that have been json_encoded """
        
    json_response = sendReq(url)

    return json_response.json() # json str response as python obj

def sendReq(url):
    #print(url+"\n")
    response = requests.get(url)

    return response
