from bs4 import BeautifulSoup
from lxml import etree
import os

## Open each document
directory = os.fsencode("herbs")

herbs = {}

for file in os.listdir(directory):
    page = open("herbs"+os.sep+os.fsdecode(file), "rb")

    soup = BeautifulSoup(page.read(), "html.parser")

## Link
    link = soup.select("meta[property*='og:url']")[0]['content']


## First latin name, as scientific name  ¯\_(ツ)_/¯
    latin_names_div = soup.select("div[class*='latinnamesul--397c']")
    for z in latin_names_div:
        latin_name = z.find('p').text.split('\xa0')[1].split(',')[0].split('(')[0]

        herbs[latin_name] = {}
        herbs[latin_name]["latin_name"] = latin_name
        herbs[latin_name]["link"] = link

## Common names, Save as list
    common_names_div = soup.select("div[class*='9c087']")
    for y in common_names_div:
        common_names = y.find('p').text.split('\xa0')[1].split(',')

        herbs[latin_name]["common_names"] = common_names

## Indication text
    indications_div = soup.find('div', {'id':'1-heading-what-have-we-learned'})
    indications = indications_div.find_all('li')
    indication_list = []
    for indication in indications:
        indication_list.append(indication.text)

    herbs[latin_name]['indication_texts'] = indication_list

## Add herbs with latin and common names
add_herbs = open("add_herbs.txt", "w")
add_common = open("add_common.txt", "w")
add_nccih = open("add_nccih.txt", "w")

add_herbs.write("INSERT INTO herbs (herb_id, herbs_scientific_name) VALUES")
add_common.write("INSERT INTO common_names (common_name, herb_id)")
add_nccih.write("INSERT INTO nccih_info (nccih_text, nccih_link, herb_id, mesh_id)")

counter = 1

for key, value in herbs.items():
    id = counter
    counter = counter + 1

    add_herbs.write("\n("+str(id)+", '"+key+"'),")

    for common in value['common_names']:
        add_common.write("\n('"+common.strip()+"', "+str(id)+"),")

    for indication in value['indication_texts']:
        add_nccih.write("\n('"+indication.strip()+"', '"+value['link']+"', "+str(id)+",' '),")

add_herbs.write("\b;")
add_common.write("\b;")
add_nccih.write("\b;")

add_herbs.close()
add_common.close()
add_nccih.close()
