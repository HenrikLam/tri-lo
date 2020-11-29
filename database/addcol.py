import csv


listingCSV = open("new_listings.csv", 'w', newline='', encoding='utf-8')
old = open("listings.csv", 'r', newline='', encoding='utf-8')
listingWriter = csv.writer(listingCSV)
oldReader = csv.reader(old)


for row in oldReader:
	print(row)
	row[-1] = 'monthly'
	row = row + ['ACTIVE','1','11/29/2020 02:20:20 pm']
	listingWriter.writerow(row)