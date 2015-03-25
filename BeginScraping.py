import sys
from twisted.internet import reactor
from scrapy.crawler import Crawler
from scrapy.settings import Settings
from scrapy import log
sys.path.append('/home/sindhura/Documents/Sem6/SE/Project/WebScraper/WebScraper/spiders')
from scrapy.contrib.spiders import CrawlSpider, Rule
from WebScraper.spiders.LPSpiders import LPSpider
from WebScraper.spiders.KTSpiders import KTSpider

def setup_crawler(domain,place):

	if domain=="lonelyPlanet":
		spider = LPSpider(place)
	elif domain=="karnatakaTourism":
		spider = KTSpider(place)
    
	crawler = Crawler(Settings())
	crawler.configure()
	crawler.crawl(spider)
	crawler.start()

place="mysore"

for domain in ['karnatakaTourism']:#,'karnatakaTourism']:
	setup_crawler(domain,place)

log.start()
reactor.run()

