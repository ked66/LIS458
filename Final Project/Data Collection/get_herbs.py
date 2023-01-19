import requests

URL = "https://www.nccih.nih.gov/health/herbsataglance"
page = requests.get(URL)


with open('herbsataglance.html', 'wb+') as f:
    f.write(page.content)
