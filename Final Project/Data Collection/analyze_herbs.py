from bs4 import BeautifulSoup
from lxml import etree
import requests, os, time

page = open('herbsataglance.html', 'rb')

soup = BeautifulSoup(page.read(), "html.parser")

herbs = {}

for x in soup.find_all('ul', attrs={'class':'herbsul'}):
    for y in x.find_all('a'):
        herbs[y.text] = {"link": "https://www.nccih.nih.gov"+y['href']}

if not os.path.exists("herbs"):
    os.makedirs("herbs")

for i in herbs:
    URL = herbs[i]['link']
    page = requests.get(URL)
    fileout = open('herbs'+os.sep+str(i)+'.html', 'wb+')
    fileout.write(page.content)
    fileout.close()
    time.sleep(2)
