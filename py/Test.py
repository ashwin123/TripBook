import scrapy
import json
import sys
from scrapy.selector import Selector
from scrapy.http import HtmlResponse
from scrapy.selector import HtmlXPathSelector
from scrapy.selector import Selector

class TestItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    title = scrapy.Field()
    category = scrapy.Field()
    descr = scrapy.Field()
    duration = scrapy.Field()
    price = scrapy.Field()

class LP(scrapy.Spider):
	name="Test"
	allowed_domains = ["http://www.lonelyplanet.com/"]
	def __init__(self,search_place):
		search_place=search_place
		#print search_place
		self.start_urls=["http://www.lonelyplanet.com/search?q="+search_place+"&type=thing_to_do"]
        
	def parse(self,response):

		list_of_urls=[]
		count=2
		for i in response.xpath('//div[@class="search__result-list"]'):
			for j in i.xpath('//div[@class="card card--hover copy--body search__result search__result--activity"]//a[@class="link--wrapper"]/@href'):
				url='http://www.lonelyplanet.com'+((("".join(j.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
				list_of_urls.append(url)

			for j in i.xpath('//div[@class="card card--hover copy--body search__result search__result--sight"]//a[@class="link--wrapper"]/@href'):
				url='http://www.lonelyplanet.com'+((("".join(j.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
				list_of_urls.append(url)
			
			
		for i in list_of_urls:
			yield scrapy.Request(i,callback=self.parseItem,dont_filter=True)

	def parseItem(self,response):

		if len(response.xpath('//div[@class="card card--page ttd"]'))!=0:
			response_xpath=response.xpath('//div[@class="card card--page ttd"]')
		else:
			response_xpath=response.xpath('//div[@class="card card--page card--top-choice ttd"]')

		for i in response_xpath:
			title=i.xpath('//div[@class="card--page__header card--page__header--headline ttd__header"]//h1[@class="copy--h1"]/text()')	
			category=i.xpath('//div[@class="card--page__header card--page__header--headline ttd__header"]//div/text()')
			
			descr=i.xpath('//div[@class="card--page__content"]//div[@class="grid-wrapper--20"]//div[@class="col--one-whole wv--col--three-fifths"]//div[@class="ttd__content context--content copy--body"]//div[@class="ttd__section ttd__section--description"]//p/text()')
			item=TestItem()
			category=((("".join(category.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
			category=category.replace('/','')
			category=category.strip()
			duration=i.xpath('//div[@class="col--one-whole mv--col--one-half wv--col--one-whole"][2]//dl[@class="info-list"]//dd[2]/text()')
       		price=i.xpath('//div[@class="col--one-whole mv--col--one-half wv--col--one-whole"][2]//dl[@class="info-list"]//dd[1]/text()')
       		item['category']=category
       		item['title']=((("".join(title.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
       		item['descr']=((("".join(descr.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
       		item['duration'] = ((("".join(duration.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
		item['price'] = ((("".join(duration.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
		if item['price']!='' and item['duration']=='':
			item['duration']=item['price']
			item['price']=''
       		yield item

