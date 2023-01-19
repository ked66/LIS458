from lxml import etree
import re
regexpNS = "http://exslt.org/regular-expressions"

## Get list of IDS that i need
readFile = open("add_nccih_edited.txt", "r")
nccih = readFile.readlines()
readFile.close()

id = re.compile("D[0-9]*(?=')")
ids = []

for line in nccih:
    a = id.search(line)
    if a:
        if a.group() in ids:
            continue
        else:
            ids.append(a.group())

doc = etree.parse("desc2022.xml")
add_mesh = open("add_mesh_2.txt", "w")
add_mesh.write("INSERT INTO indications (indication_mesh_id, indication_mesh_name) VALUES")

for id in ids:
    target = doc.xpath(""".//DescriptorRecord/DescriptorUI[text() = '"""+id+"""']/../DescriptorName/String""")

    add_mesh.write("\n('"+id+"', '"+target[0].text+"'),")

add_mesh.write("\b;")

add_mesh.close()
