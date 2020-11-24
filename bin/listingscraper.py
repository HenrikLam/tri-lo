import requests
import urllib.request
from bs4 import BeautifulSoup
from selenium import webdriver
from collections import defaultdict
import json
import csv

links = '''
https://www.zillow.com/homedetails/84-6th-Ave-Troy-NY-12180/32234150_zpid/

https://www.zillow.com/homedetails/3-Plum-Ave-Troy-NY-12180/201864301_zpid

https://www.zillow.com/homedetails/110-Colleen-Rd-29ZNDKPTJ-Troy-NY-12180/2081917760_zpid

https://www.zillow.com/homedetails/200-Broadway-301-Troy-NY-12180/2077653813_zpid

https://www.zillow.com/homedetails/190-10th-St-2-Troy-NY-12180/2090597883_zpid

https://www.zillow.com/homedetails/145-George-St-1-Troy-NY-12183/2077142410_zpid

https://www.zillow.com/homedetails/154-3rd-St-FLOOR-2-Troy-NY-12180/2077154399_zpid

https://www.zillow.com/homedetails/224-6th-Ave-1-Troy-NY-12180/2077162742_zpid

https://www.zillow.com/homedetails/198-Pawling-Ave-PNQNHPNRQ-Troy-NY-12180/2077163835_zpid

https://www.zillow.com/homedetails/17-Myrtle-Ave-Troy-NY-12180/32239651_zpid

https://www.zillow.com/homedetails/136-Oakwood-Ave-2-Troy-NY-12180/2077182113_zpid

https://www.zillow.com/homedetails/85-7th-Ave-1-Troy-NY-12180/2077184630_zpid

https://www.zillow.com/homedetails/2-114th-St-2-Troy-NY-12182/2077187700_zpid

https://www.zillow.com/homedetails/7-Blakley-Ct-2-Troy-NY-12180/2077208239_zpid

https://www.zillow.com/homedetails/226-6th-Ave-Troy-NY-12180/32233768_zpid

https://www.zillow.com/homedetails/2328-16th-St-FLOOR-2-Troy-NY-12180/2077224974_zpid

https://www.zillow.com/homedetails/4-Spence-St-Troy-NY-12180/32240718_zpid

https://www.zillow.com/homedetails/318-1st-St-2-Troy-NY-12180/2093050773_zpid

https://www.zillow.com/homedetails/196-1st-St-3-Troy-NY-12180/2077234507_zpid

https://www.zillow.com/homedetails/4-Plum-Ave-Troy-NY-12180/32240350_zpid

https://www.zillow.com/homedetails/126-2nd-St-Troy-NY-12180/201859858_zpid

https://www.zillow.com/homedetails/1105-Hutton-St-1-Troy-NY-12180/2081175165_zpid

https://www.zillow.com/homedetails/87-4th-St-3-Troy-NY-12180/2077283501_zpid

https://www.zillow.com/homedetails/1869-Highland-Ave-2-Troy-NY-12180/2077284824_zpid

https://www.zillow.com/homedetails/576-3rd-Ave-Troy-NY-12182/2082447090_zpid

https://www.zillow.com/homedetails/450-Taylor-Ct-2-Troy-NY-12180/2080843729_zpid

https://www.zillow.com/homedetails/2539-6th-Ave-Troy-NY-12180/201913752_zpid

https://www.zillow.com/homedetails/50-2nd-St-2-Troy-NY-12180/2079979751_zpid

https://www.zillow.com/homedetails/285-5th-Ave-2-Troy-NY-12182/2090951435_zpid

https://www.zillow.com/homedetails/38-State-St-3-Troy-NY-12180/2079831470_zpid

https://www.zillow.com/homedetails/523-4th-St-Troy-NY-12180/32238026_zpid

https://www.zillow.com/homedetails/20-Vandenburgh-Ave-Troy-NY-12180/32240386_zpid/

https://www.zillow.com/homedetails/5-Cypress-St-3-Troy-NY-12180/2077344403_zpid/

https://www.zillow.com/homedetails/211-Stowe-Ave-2-Troy-NY-12180/2080584630_zpid/

https://www.zillow.com/homedetails/109-Orchard-Ave-1-Troy-NY-12180/2077354279_zpid/

https://www.zillow.com/homedetails/220-3rd-St-Troy-NY-12180/201860179_zpid/

https://www.zillow.com/homedetails/177-2nd-St-APT-2R-Troy-NY-12180/2077377978_zpid/

https://www.zillow.com/homedetails/182-River-St-Troy-NY-12180/201857608_zpid/

https://www.zillow.com/homedetails/3-115th-St-9-Troy-NY-12182/2077416592_zpid/

https://www.zillow.com/homedetails/294-4th-St-3-Troy-NY-12180/2080185335_zpid/

https://www.zillow.com/homedetails/328-1st-St-1-Troy-NY-12180/2080364119_zpid/

https://www.zillow.com/homedetails/75-4th-St-4-Troy-NY-12180/2080031197_zpid/

https://www.zillow.com/homedetails/502-Broadway-B-Troy-NY-12180/2077474952_zpid/

https://www.zillow.com/homedetails/108-4th-St-2-Troy-NY-12180/2080137907_zpid/

https://www.zillow.com/homedetails/64-Oakwood-Ave-B-Troy-NY-12180/2093644754_zpid/

https://www.zillow.com/homedetails/189-2nd-St-Troy-NY-12180/32235029_zpid/

https://www.zillow.com/homedetails/331-4th-St-1-Troy-NY-12180/2078713841_zpid/

https://www.zillow.com/homedetails/2-Stow-Ave-2-Troy-NY-12180/2077486911_zpid/

https://www.zillow.com/homedetails/14-108th-St-2-Troy-NY-12182/2095230786_zpid/

https://www.zillow.com/homedetails/25-Starbuck-Dr-310-Troy-NY-12183/2077543558_zpid/

https://www.zillow.com/homedetails/187-Paine-St-2-Troy-NY-12183/2077547846_zpid/

https://www.zillow.com/homedetails/427-8th-Ave-Troy-NY-12182/32233297_zpid/

https://www.zillow.com/homedetails/435-10th-St-1-Troy-NY-12180/2077594038_zpid/

https://www.zillow.com/homedetails/1939-5th-Ave-2-Troy-NY-12180/2088125506_zpid/

https://www.zillow.com/homedetails/194-4th-St-FLOOR-3-Troy-NY-12180/2077684761_zpid/

https://www.zillow.com/homedetails/39-1st-St-Troy-NY-12180/32234985_zpid/

https://www.zillow.com/homedetails/3-St-Pauls-Pl-1-Troy-NY-12180/2086258044_zpid/

https://www.zillow.com/homedetails/1821-5th-Ave-APT-6-Troy-NY-12180/2100305788_zpid/

https://www.zillow.com/homedetails/2168-14th-St-1-Troy-NY-12180/2078294382_zpid/

https://www.zillow.com/homedetails/84-King-St-APT-5-Troy-NY-12180/2107142396_zpid/

https://www.zillow.com/homedetails/120-3rd-St-APT-3-Troy-NY-12180/2080670204_zpid/

https://www.zillow.com/homedetails/1649-5th-Ave-BASEMENT-Troy-NY-12180/2077972083_zpid/

https://www.zillow.com/homedetails/241-2nd-St-F-1-Troy-NY-12180/2078379051_zpid/

https://www.zillow.com/homedetails/65-3rd-St-APT-204-Troy-NY-12180/2096474937_zpid/

https://www.zillow.com/homedetails/270-8th-St-FLOOR-2-Troy-NY-12180/2079767383_zpid/

https://www.zillow.com/homedetails/171-9th-St-1-Troy-NY-12180/2090502627_zpid/

https://www.zillow.com/homedetails/1100-River-View-Dr-Green-Island-NY-12183/2122514349_zpid/
'''

def parse(info):
	dic = json.loads(info['apiCache'])
	props = dic[list(dic.keys())[0]]['property']

	ret = dict()
	prop = defaultdict(lambda: None)

	for p in props:
		prop[p] = props[p]

	ret['id'] = i
	ret['streetAddress'] = prop['streetAddress']
	ret['city'] = prop['city']
	ret['state'] = prop['state']
	ret['zipcode'] = prop['zipcode'] 
	ret['latitude'] = prop['latitude']
	ret['longitude'] = prop['longitude']
	ret['price'] = prop['price']
	ret['bathrooms'] = prop['bathrooms']
	ret['bedrooms'] = prop['bedrooms']
	ret['squareFeet'] = prop['livingArea']
	ret['isRenting'] = prop['homeStatus'] == 'FOR_RENT'
	ret['frequency'] = 'month'
	return ret

def images(al):
	ret = []
	global j
	
	for a in al:
		link = str(a)
		link = link[link.find('src="')+5:-3]
		ret.append({'id':j,'listing_id':i,'link':link})
		j = j + 1

	return ret


browser = webdriver.Chrome()
i = 1
j = 1

listingCSV = open("listings.csv", 'w', newline='', encoding='utf-8')
imageCSV = open("images.csv", 'w', newline='', encoding='utf-8')

listingWriter = csv.writer(listingCSV)
imageWriter = csv.writer(imageCSV)

for url in links.split("\n\n"):
	sada = browser.get(url)
	
	source = browser.page_source
	soup = BeautifulSoup(source, 'html.parser')

	info = str(soup.find(id="hdpApolloPreloadedData"))
	info = info[info.find('{'):info.rfind('}')+1]
	try:
		dic = json.loads(info)
	except json.decoder.JSONDecodeError:
		continue
	data = parse(dic)
	img = images(soup.find_all("img", "photo-tile-image"))

	if i == 1:
		listingWriter.writerow(data.keys())
		imageWriter.writerow(img[0].keys())

	listingWriter.writerow(data.values())
	for im in img:
		imageWriter.writerow(im.values())
	i = i + 1

browser.quit()