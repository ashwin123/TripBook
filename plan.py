import math
import copy

#####################################  	Itinerary and budget planning ##########################################
#duration in hoursminutes
#Locations are destinations for a particular place

#details is a dictionary where value of locations is an array of dictionaries

#Add latitude and longitude also later to calculate distance between locations

############################################# Input ##############################################################

#Test case 1
details= {'place': 'mysore', 
	'locations': [
	{'loc': 'Mysore palace', 'duration': 300, 'sttime':1600, 'endtime': 1900, 'cost': 2000}, 
	{'loc': 'Mysore Zoo', 'duration': 400, 'sttime':1600, 'endtime': 2000, 'cost': 1000}, 
	{'loc': 'Karangi Lake', 'duration': 300, 'sttime':0, 'endtime': 0, 'cost': 500}, 
	{'loc': 'Regional Museum of Natural History', 'duration': 130, 'sttime':0, 'endtime': 0, 'cost': 500},
	{'loc': 'Brindavan Gardens', 'duration': 200, 'sttime':1600, 'endtime': 1800, 'cost': 100},
	{'loc': 'Lalitha Mahal', 'duration': 200, 'sttime':900, 'endtime': 1100, 'cost': 400},
	{'loc': 'Railway Museum', 'duration': 300, 'sttime':0, 'endtime': 0, 'cost': 1000},
	{'loc': 'Kukkarahalli Lake', 'duration': 300, 'sttime':0, 'endtime': 0, 'cost': 500}
]}


#Test case 2
# details= {'place': 'mysore', 
# 	'locations': [
# 	{'loc': 'Mysore palace', 'duration': 300, 'sttime':1600, 'endtime': 1900, 'cost': 2000}, 
# 	{'loc': 'Mysore Zoo', 'duration': 400, 'sttime':1600, 'endtime': 2000, 'cost': 1000}, 
# 	{'loc': 'Karangi Lake', 'duration': 300, 'sttime':0, 'endtime': 0, 'cost': 500}, 
# 	{'loc': 'Regional Museum of Natural History', 'duration': 130, 'sttime':0, 'endtime': 0, 'cost': 500},
# 	{'loc': 'Brindavan Gardens', 'duration': 200, 'sttime':1600, 'endtime': 1800, 'cost': 100},
# ]}


#Calculated intervals
intervals= {}

lunch= [1330, 1430]
noDays= 3
time= [900, 2100]

temp= details
result= {}

inputBudget= 4525
inputBudget+= 500

###########################################################################################################################

def getDetails():
	#Use this function to get the details from web
	pass

def distanceTime(loc1, loc2):
	#Use this function to calculate time between two locations considering factors like traffic etc
	#return math.abs(loc1- loc2)+ 0.5
	#Returning random value for now
	return 100

def bestFit():
	#Main function which returns final result
	for entry in temp['locations']:
		if(entry['sttime']== 0):
			entry['duration']+= distanceTime('currentLocation', entry)

	calcInitIntervals()
	fitFixedTimes()
	delFixedLocations()
	cleanUp()
	fitOtherTimes()
	
	budgetPlanning()
	formatResult()

def calcInitIntervals():
	#To divide a day into intervals
	for d in range(0, noDays):

		l= [[time[0], lunch[0]], [lunch[1], time[1]]]
		intervals['Day'+str(d+1)]= l


def fitFixedTimes():
	#To fix time and day for given time entries
	global temp
	global intervals
	i=0
	for entry in temp['locations']:
		flag=0
		if(entry['sttime']> 0):

			#Deep copy so that newD will have a separate reference from intervals
			newD= copy.deepcopy(intervals)

			for k, v in intervals.items():

				#If k is not a key of result
				if(result.get(k, 'empty')== 'empty'):
					result[k]= []

				#If a single location occupies an entire day
				if(entry['duration']> 700):

					#Temporary dictionary d
					d= {}
					d['place']= entry['loc']
					d['sttime']= entry['sttime']
					d['endtime']= entry['endtime']
					d['cost']= entry['cost']
					result[k].append(d)
					flag=1

				else:
					j=0
					for inter in v:

						#If the duration can be fit in an interval with a padding of 15min being provided here
						if(inter[0]-15<= entry['sttime']<=inter[1]+15 and inter[0]-15<= entry['endtime']<=inter[1]+15):

							#Temporary dictionary d
							d= {}
							d['place']= entry['loc']
							d['sttime']= entry['sttime']
							d['endtime']= entry['endtime']
							d['cost']= entry['cost']
							result[k].append(d)
							if(entry['sttime']- inter[0]>=30):
								newD[k].append([inter[0], entry['sttime']])
							del(newD[k][j])
							if(inter[1]- entry['endtime']>=30):
								newD[k].append([entry['endtime'], inter[1]])
							flag=1
							break
						j+=1
				if(flag==1):
					break
			intervals= newD
		i+=1

def delFixedLocations():
	#To remove the places for which time has already been allotted
	global temp
	temp['locations']= [d for d in temp['locations'] if d['sttime']==0]


def cleanUp():
	#To merge intervals which are very close to each other
	for k,v in intervals.items():
		for i in range(0, len(v)-1):
			if(v[i+1][0]-v[i][1] <=30):
				v[i]= [v[i][0], v[i+1][1]]
	

def fitOtherTimes():
	#To find best fit of locations other than those whose time is fixed
	for entry in temp['locations']:

		#Assign minimum error to some large value
		minError= 9999999999

		#Temporary dictionary d
		d= {}
		flag=0
		val= 0
		key= ""
		for k, v in intervals.items():
			if(result.get(k, 'empty')== 'empty'):
				result[k]= []
			j=0
			val= j
			for inter in v:
				error= squareError(entry['duration'], inter)
				if(minError> error and inter[0]+ entry['duration']<=time[1] and inter[0]+entry['duration']<= inter[1]):
					flag=1
					minError= error	
					key= k
					d['place']= entry['loc']
					d['sttime']= inter[0]
					d['endtime']= inter[0]+entry['duration']
					d['cost']= entry['cost']
					val= j

				j+=1

		if(flag==1):
			result[key].append(d)
			if(intervals[key][val][1]- d['endtime']<=30):
				del intervals[key][val]
			else:
				intervals[key][val][0]= d['endtime']


def squareError(d, l):
	#Calculate the mean squared error for the calculated best fit
	return (d- (l[1]-l[0]))*(d- (l[1]-l[0]))


def formatResult():

	#List of dictionary of all places that can be visited
	vplaces= []

	#List of dictionary of all the places from user input
	allplaces= []
	print("\n######################### Itinerary Planning #############################\n")
	for k, v in result.items():
		print("On ", k)
		for val in v:
			vplaces.append(val['place'])
			print("Place: ", val['place'], ", Start time: ", val['sttime'], ", End time: ", val['endtime'])

	print("\n################### Places that cannot be visited ######################\n")

	for v in details['locations']:
		allplaces.append(v['loc'])

	#List set subtraction
	l= list(set(allplaces)- set(vplaces))
	for i in l:
		print(i)
	print()
	print()


def budgetPlanning():
	print("\n######################### Budget Planning #############################\n")
	global result
	total= 0
	for k, v in result.items():
		for val in v:
			total+= val['cost']
			print("Place: ", val['place'], ", Cost: ", val['cost'])

	print("\nTotal approximated cost= ", total, "\n")


	#Fit user input Budget and reform the result
	newD= {}
	if(inputBudget < total):

		#List of costs of all places
		cost= []

		#Cost of places which have to be deleted because of insufficient budget
		deletedCost= []

		errorBudget= total- inputBudget

		#Populate cost list
		for k, v in result.items():
			for val in v:
				cost.append(val['cost'])
		cost.sort(reverse= True)

		#If user budget is lower than that of maximum cost of a place he has chosen, remove the costliet place
		#This is done untl the error is less than or equal to the maximum cost value
		while(errorBudget>= max(cost)):
			temp= max(cost)
			deletedCost.append(temp)
			cost.remove(temp)
			errorBudget-= temp

		minBudgetError= max(cost)- errorBudget
		pos= cost.index(max(cost))
		for i in range(len(cost)):
			if(minBudgetError == max(cost)):
				break

			#If some cost produces minimum error, remove that
			elif(cost[i]- errorBudget>=0 and cost[i]- errorBudget < minBudgetError):
				minBudgetError= cost[i]- errorBudget
				pos= i

		if(pos != -1):
			deletedCost.append(cost[pos])
			cost.remove(cost[pos])

		for k, v in result.items():
			for val in v:
				if(val['cost'] in cost):
					cost.remove(val['cost'])
					if(newD.get(k, 'empty')== 'empty'):
						newD[k]= []
					newD[k].append(val)

		result= newD

		#Call the new budget planner based on user budget
		reformedBudgetPlanning()

def reformedBudgetPlanning():
	print("\n####################### Reformed Budget Planning ###########################\n")
	total= 0
	for k, v in result.items():
		for val in v:
			total+= val['cost']
			print("Place: ", val['place'], ", Cost: ", val['cost'])

	print("\nPlanned Budget cost= ", total, "\n")

bestFit()