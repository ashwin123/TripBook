#!/usr/bin python3


import math
import copy
import json
import ast

#####################################  	Itinerary and budget planning ##########################################
#duration in hoursminutes
#Locations are destinations for a particular place

#details is a dictionary where value of locations is an array of dictionaries

#Add latitude and longitude also later to calculate distance between locations

############################################# Input ##############################################################

#Test case 1
# details= {'place': 'mysore', 
# 	'locations': [
# 	{'loc': 'Mysore palace', 'duration': 300, 'priority': 1, 'sttime':1600, 'endtime': 1900, 'cost': 2000, 'open': 1400, 'close': 1900}, 
# 	{'loc': 'Mysore Zoo', 'duration': 400, 'priority': 2, 'sttime':1600, 'endtime': 2000, 'cost': 1000, 'open': 900, 'close': 2000}, 
# 	{'loc': 'Karangi Lake', 'duration': 300, 'priority': 3, 'sttime':0, 'endtime': 0, 'cost': 500, 'open': 900, 'close': 2000}, 
# 	{'loc': 'Regional Museum of Natural History', 'priority': 4, 'duration': 130, 'sttime':0, 'endtime': 0, 'cost': 500, 'open': 900, 'close': 2000},
# 	{'loc': 'Brindavan Gardens', 'duration': 200, 'priority': 5, 'sttime':1600, 'endtime': 1800, 'cost': 100, 'open': 900, 'close': 2000},
# 	{'loc': 'Lalitha Mahal', 'duration': 200, 'priority': 6, 'sttime':900, 'endtime': 1100, 'cost': 400, 'open': 900, 'close': 2000},
# 	{'loc': 'Railway Museum', 'duration': 300, 'priority': 7, 'sttime':0, 'endtime': 0, 'cost': 1000, 'open': 900, 'close': 2000},
# 	{'loc': 'Kukkarahalli Lake', 'duration': 300, 'priority': 8, 'sttime':0, 'endtime': 0, 'cost': 500, 'open': 900, 'close': 2000}
# ]}


# #Calculated intervals
# intervals= {}

# lunch= [1330, 1430]
# noDays= 1
# time= [900, 2100]

# temp= []
# result= {}
# output= []

# inputBudget= 2525
# #inputBudget+= 500


intervals= {}
noDays= 0
inputBudget= 0
output= []
result= {}
temp= []
time= []

lunch= [1330, 1430]
details= {}


###########################################################################################################################

def getDetails():
	#Use this function to get the details from file

	data= []

	global details
	global noDays
	global inputBudget
	global time

	fp= open("data.txt", "r")

	for line in fp:
		line= line.strip('\n')

		data.append(line)

	details= ast.literal_eval(data[0])
	noDays= int(data[1])
	time= ast.literal_eval(data[2])
	inputBudget= int(data[3])+500

def distanceTime(loc1, loc2):
	#Use this function to calculate time between two locations considering factors like traffic etc
	#return math.abs(loc1- loc2)+ 0.5
	#Returning random value for now
	return 100

def bestFit():
	#Main function which returns final result

	getDetails()

	for entry in temp:
		if(entry['sttime']== 0):
			entry['duration']+= distanceTime('currentLocation', entry)

	popTemp()
	calcInitIntervals()
	fitTimes()
	
	budgetPlanning()
	formatResult()


def popTemp():
	#populate list called temp in order of priorities
	for entry in details['locations']:
		temp.append(0)

	for entry in details['locations']:
		temp[entry['priority']-1]= entry 

def calcInitIntervals():
	#To divide a day into intervals
	for d in range(0, noDays):

		l= [[time[0], lunch[0]], [lunch[1], time[1]]]
		intervals['Day'+str(d+1)]= l


def fitTimes():

	val=0
	key=""
	for entry in temp:
		flag= 0
		d= {}
		if(entry['sttime']==0):
			for k, v in intervals.items():
				if(result.get(k, 'empty')== 'empty'):
					result[k]= []

				j=0
				for inter in v:	
					if(inter[0] <= entry['open'] < inter[1] and entry['open']+entry['duration'] <= inter[1]):
						key=k
						val=j
						flag=1
						d['place']= entry['loc']
						d['sttime']= entry['open']
						d['endtime']= entry['open']+ entry['duration']
						d['cost']= entry['cost']
						d['priority']= entry['priority']
						result[k].append(d)
						break

					elif(inter[0]> entry['open'] and entry['open']+entry['duration']<= inter[1]):
						key=k
						val=j
						flag=1
						d['place']= entry['loc']
						d['sttime']= inter[0]
						d['endtime']= inter[0]+ entry['duration']
						d['cost']= entry['cost']
						d['priority']= entry['priority']
						result[k].append(d)
						break
					j+=1

				if(flag):
					break
			if(flag):
				if(intervals[key][val][1]- d['endtime']<=30):
					del intervals[key][val]
				else:
					intervals[key][val][0]= d['endtime']

		else:
			for k, v in intervals.items():
				if(result.get(k, 'empty')== 'empty'):
					result[k]= []

				j=0
				for inter in v:
					if(inter[0]<= entry['sttime'] <=inter[1] and inter[0]<= entry['endtime'] <=inter[1]):
						flag=1
						key= k
						val= j
						d= {}
						d['place']= entry['loc']
						d['sttime']= entry['sttime']
						d['endtime']= entry['endtime']
						d['cost']= entry['cost']
						d['priority']= entry['priority']
						result[k].append(d)
						break
					j+=1

				if(flag):
					break

			if(flag== 0):
				for k, v in intervals.items():
					if(result.get(k, 'empty')== 'empty'):
						result[k]= []

					j=0
					for inter in v:			
						if(inter[0] <= entry['open'] < inter[1] and entry['open']+entry['duration'] <= inter[1]):
							flag=1
							key= k
							val= j
							d['place']= entry['loc']
							d['sttime']= entry['open']
							d['endtime']= entry['open']+ entry['duration']
							d['cost']= entry['cost']
							d['priority']= entry['priority']
							result[k].append(d)
							break

						elif(inter[0]> entry['open'] and entry['open']+entry['duration']<= inter[1]):
							flag=1
							key= k
							val= j
							d['place']= entry['loc']
							d['sttime']= inter[0]
							d['endtime']= inter[0]+ entry['duration']
							d['cost']= entry['cost']
							d['priority']= entry['priority']
							result[k].append(d)
							break
						j+=1

					if(flag):
						break	

			if(flag):
				if(intervals[key][val][1]- d['endtime']<=30):
					del intervals[key][val]
				else:
					intervals[key][val][0]= d['endtime']		



def formatResult():

	#List of dictionary of all places that can be visited
	vplaces= []

	#List of dictionary of all the places from user input
	allplaces= []
	for k, v in result.items():
		for val in v:
			vplaces.append(val['place'])


	for v in details['locations']:
		allplaces.append(v['loc'])

	#List set subtraction
	l= list(set(allplaces)- set(vplaces))
	print l

def budgetPlanning():
	global result
	total= 0
	for k, v in result.items():
		for val in v:
			total+= val['cost']


	json1= json.dumps(result, ensure_ascii=False)

	fp= open("temp1", "w")
	fp.write(json1)

	fp.close()

	print total


	#Fit user input Budget and reform the result
	newD= {}
	i=0
	while(inputBudget <= total):
		i-=1
		newD= result
		maxPriority= temp[i]['priority']
		flag=0
		for k, v in result.items():
			j=-1
			for val in v:
				j+=1
				if(val['priority']== maxPriority):
					total-= val['cost']
					del newD[k][j]
					flag=1
					break

			if(flag):
				break
		result= newD
	reformedBudgetPlanning()

def reformedBudgetPlanning():
	total= 0
	for k, v in result.items():
		for val in v:
			total+= val['cost']

	json2= json.dumps(result, ensure_ascii=False)

	fp= open("temp2", "w")
	fp.write(json2)

	fp.close()

	print total

bestFit()