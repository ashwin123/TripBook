# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class LPItem(scrapy.Item):
    	# define the fields for your item here like:
    	# name = scrapy.Field()
	title = scrapy.Field()
	category = scrapy.Field()
	descr = scrapy.Field()
	pass

'''class IIItem(scrapy.Item):
    	# define the fields for your item here like:
    	# name = scrapy.Field()
	pass'''

class KTItem(scrapy.Item):
    	# define the fields for your item here like:
    	# name = scrapy.Field()
	title = scrapy.Field()
	link = scrapy.Field()
	desc = scrapy.Field()
    
	pass
