import scrapy
import json
from scrapy.selector import Selector
from scrapy.http import HtmlResponse
from scrapy.selector import HtmlXPathSelector
from scrapy.selector import Selector
from scrapy.contrib.spiders import CrawlSpider, Rule
from scrapy.contrib.linkextractors import LinkExtractor
import sys
sys.path.append('/home/sindhura/Documents/Sem6/SE/Project/WebScraper')
from WebScraper.items import KTItem

class KTSpider(CrawlSpider):
	def __init__(self,place):
		self.name = 'hampi'
   		self.allowed_domains = ['karnataka.com']
		self.place=place
    		self.start_urls = ['http://www.karnataka.com/'+self.place]
		
    		self._rules = (Rule(LinkExtractor(allow=(r'/'+self.place+'/.*/', )),callback='parse_item'),)
	
	def parse_item(self, response):
		self.log('Hi, this is an item page! %s' % response.url)
	        item = KTItem()
	        item['title'] = response.xpath('//h1[@class="entry-title"]/text()').extract()
	        item['desc'] = response.xpath('//div[@class="entry-content"]/p/text()').extract()
	        yield item
