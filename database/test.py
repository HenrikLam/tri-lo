import csv

file = open('listings.csv', 'r')

new = open("new_listings.csv", 'w', newline='', encoding='utf-8')
writer = csv.writer(new)

for row in csv.reader(file):
	row[-1] = "2020-11-29 12:00:00"
	writer.writerow(row + ["Listing " + row[0]])