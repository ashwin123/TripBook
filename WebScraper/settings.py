# -*- coding: utf-8 -*-

# Scrapy settings for karnataka project
#
# For simplicity, this file contains only the most important settings by
# default. All the other settings are documented here:
#
#     http://doc.scrapy.org/en/latest/topics/settings.html
#

BOT_NAME = 'webscraper'

SPIDER_MODULES = ['WebScraper.spiders']
NEWSPIDER_MODULE = 'WebScraper.spiders'
# Crawl responsibly by identifying yourself (and your website) on the user-agent
#USER_AGENT = 'karnataka (+http://www.yourdomain.com)'
ITEM_PIPELINES = ['WebScraper.pipelines.WebScraperPipeline',]
MONGODB_SERVER = "localhost"
MONGODB_PORT = 27017
MONGODB_DB = "test"
MONGODB_COLLECTION = "t1"
