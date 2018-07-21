from __future__ import print_function
from sys import stderr

import requests
from json import dumps,loads,decoder

def eprint(*args, **kwargs):
    print(*args, file=stderr, **kwargs)

def json_encode(json_obj): # rename
    return dumps(json_obj)

def json_decode(json_str): # rename
    return loads(json_str)

def sendReceiveReq(url, method = "get", data = {}):
    """ sends and loads a json response from the given url,
        url corresponds to a local php script stored on the server,
        all such php scripts will only return objects that have been json_encoded
        """
    try:
        json_response = sendReq(url, method, data)

        #eprint(json_response.text)
        #eprint(json_response.json())
        return json_response.json() # json str response as python obj

    except decoder.JSONDecodeError:
        eprint("\n{}\njson_response:\n{}\n".format(url,json_response.text))
        exit()

def sendReq(url, method = "get", data = {}):
    #print(url+"\n")
    if method == "get":
        for k in data.keys():
            url += "{}={}&".format(k,data[k])

        response = requests.get(url[:-1]) # the last char of url is the extra '&'

    elif method == "post":
        response = requests.post(url, data)

    else:
        eprint("sendReq()\nurl: {}\nmethod: {}".format(url,method))
        exit()

    #eprint(url)
    return response
