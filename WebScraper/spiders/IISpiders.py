import scrapy
import json
from scrapy.selector import Selector
from scrapy.http import HtmlResponse
from scrapy.selector import HtmlXPathSelector
from scrapy.selector import Selector

import sys
sys.path.append('/home/sindhura/Documents/Sem6/SE/Project/WebScraper')
from WebScraper.items import IIItem


class IISpider(scrapy.Spider):
	def __init__(self,name,dom,place):
	
		self.name = "IISpider"
		self.place=place
	    	self.allowed_domains = ["http://www.incredibleindia.org/en/travel/destination/"+self.place+"/"+self.place+"-things-to-do/"+self.place+"-sites-to-see"]
	 	self.start_urls = ["http://www.incredibleindia.org/en/travel/destination/"+self.place+"/"+self.place+"-things-to-do/"+self.place+"-sites-to-see"]
		
	def parse(self, response):
	        filename = response.url.split("/")[-2]
		for i in response.xpath('//div[@class="search__result-meta search__result-meta--overflow media__body"]'):
			category=i.xpath('.//span[@class="search__result-type copy--caption"]/text()')
			title=i.xpath('.//h3[@class="search__result-title copy--h1"]/text()')
			context=i.xpath('.//h3[@class="search__result-title copy--h1"]/span[@class="search__result-title-context"]/	text)')	
			descr=i.xpath('.//p[@class="search__result-description"]/text()')
			item=ScrapingItem()
			item['title']=(("".join(title.extract())).replace('\n',' ')).strip()
	
        		item['category']=((("".join(category.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
        		item['context']=((("".join(context.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
        		item['descr']=((("".join(descr.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
			#s=item['title']+" "+item['category']+" "+item['context']+" "+item['descr']+"\n"
			yield item
             
        
