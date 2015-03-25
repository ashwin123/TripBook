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
from WebScraper.items import LPItem


class LPSpider(CrawlSpider):
	def __init__(self,place):
	
		self.name = "LPSpider"
		self.place=place
	    	self.allowed_domains = ["http://www.lonelyplanet.com" ]
	 	self.start_urls = ["http://www.lonelyplanet.com/search?q="+self.place+"&type=thing_to_do" ]
		self._rules = (Rule(LinkExtractor(allow=(r'/'+self.place+'/.*/', )),callback='parse_item'),)

	def parse_item(self, response):
		#get title,category,context,descr,prices,duration,etc.
		for i in response.xpath('//div[@class="card card--page ttd"]'):

			title=i.xpath('//div[@class="card--page__header card--page__header--headline ttd__header"]//h1[@class="copy--h1"]');

			category=i.xpath('//div[@class="card--page__breadcrumb icon--activity--pin--simple--before"]');

			descr=i.xpath('//div[@class="card--page__content"]//div[@class="grid-wrapper--20"]//div[@class="col--one-whole wv--col--three-fifths"]//div[@class=""]//div[@class="ttd__content context--content copy--body"]//div[@class="grid-wrapper--20"]//p/following::p');

			#prices=i.xpath('//div[@class="card--page__content"]//div[@class="grid-wrapper--20"]//div[@class="col--one-whole wv--col--two-fifths col--right js-will-move"]//div[@class="ttd__aside ttd__aside--atlas js-ttd__aside"]//div[@class="ttd__section ttd__section--description"]//div[@class="col--one-whole mv--col--one-half wv--col--one-whole"]/following::dt');	#get dt's for prices,opening hours,etc. 
			#<dt class='copy--h3 info-list__title text-icon icon--bureau-de-change--before icon--lp-blue--before'> = prices
			#<dt class='copy--h3 info-list__title text-icon icon--time--before icon--lp-blue--before'> = opening hours (applicable to some places only

			item['title']=(("".join(title.extract())).replace('\n',' ')).strip()
        		item['category']=((("".join(category.extract())).replace('\n',' ')).strip('/')).encode('ascii','ignore')
        		item['descr']=((("".join(descr.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
			yield item
		'''for i in response.xpath('//div[@class="search__result-meta search__result-meta--overflow media__body"]'):
			category=i.xpath('.//span[@class="search__result-type copy--caption"]/text()')
			title=i.xpath('.//h3[@class="search__result-title copy--h1"]/text()')
			context=i.xpath('.//h3[@class="search__result-title copy--h1"]/span[@class="search__result-title-context"]/	text)')	
			descr=i.xpath('.//p[@class="search__result-description"]/text()')
			item=LPItem()
			item['title']=(("".join(title.extract())).replace('\n',' ')).strip()
	
        		item['category']=((("".join(category.extract())).replace('\n',' ')).strip('/')).encode('ascii','ignore')
        		item['context']=((("".join(context.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
        		item['descr']=((("".join(descr.extract())).replace('\n',' ')).strip()).encode('ascii','ignore')
			#s=item['title']+" "+item['category']+" "+item['context']+" "+item['descr']+"\n"
			yield item'''
             
        
