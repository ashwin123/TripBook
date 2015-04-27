#!/usr/bin/python
from pymongo import MongoClient
import sys, json
import os
import cgi, cgitb
from bson.json_util import dumps

cgitb.enable()
import commands

client=MongoClient('localhost',27017)

myjson = json.load(sys.stdin)
search_place=myjson['place']
# Do something with 'myjson' object
db=client['tripbook']    #extract district name from http request pass and pass as an argument
collectionlist=db.collection_names()
print 'Content-Type: application/json\n\n'
if search_place in collectionlist:
	coll=db[search_place]
	getplace=coll.find()
	print dumps(getplace)
else:
	
	with open("config.py","w") as f:
		f.write(search_place)
	
	with open("items.json","w") as f:
		f.close()
	
	os.system("scrapy runspider Test.py -o items.json -t json -a search_place="+search_place)
	
	with open("items.json","r") as f:
		js=f.read()

	if js=='[':
		print json.dumps({'exception':'place not found'})

	else:
		js=eval(js)
		db.create_collection(search_place)
		coll=db[search_place]
		coll.insert(js)
		print dumps(js)
	
