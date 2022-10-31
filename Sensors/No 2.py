import dht,machine
from machine import Pin
import ujson, json
import time, network
import urequests as requests

#DHT PIN Configuration
d22 = dht.DHT22(machine.Pin(4))

SSID="Qing Shuo"
PASSWD="Staycation100%_"

ip='http://192.168.0.105'

#LED PIN Configuration
ledR =  Pin(14, Pin.OUT)
ledG =  Pin(12, Pin.OUT)
ledB =  Pin(13, Pin.OUT)

def LEDSW(RED, GREEN, BLUE):
    if RED == 0 and GREEN == 0 and BLUE == 0:
        ledR.value(0)
        ledG.value(0)
        ledB.value(0)
        print('Semua OFF')
    elif RED == 1 and GREEN == 0 and BLUE == 0:
        ledR.value(1)
        ledG.value(0)
        ledB.value(0)
        print('Merah Nyala')
    elif RED == 0 and GREEN == 1 and BLUE == 0:
        ledR.value(0)
        ledG.value(1)
        ledB.value(0)
        print('Hijau Nyala')
    elif RED == 0 and GREEN == 0 and BLUE == 1:
        ledR.value(0)
        ledG.value(0)
        ledB.value(1)
        print('Biru Nyala')
    elif RED == 1 and GREEN == 1 and BLUE == 0:
        ledR.value(1)
        ledG.value(1)
        ledB.value(0)
    elif RED == 1 and GREEN == 0 and BLUE == 1:
        ledR.value(1)
        ledG.value(0)
        ledB.value(1)
    elif RED == 0 and GREEN == 1 and BLUE == 1:
        ledR.value(0)
        ledG.value(1)
        ledB.value(1)
    elif RED == 1 and GREEN == 1 and BLUE == 1:
        ledR.value(1)
        ledG.value(1)
        ledB.value(1)

sta_if = network.WLAN(network.STA_IF)

if not sta_if.isconnected():
    print('Connecting to network...')
    sta_if.active(True)
    sta_if.connect(SSID, PASSWD)
    # 等一下它連接
    while not sta_if.isconnected():
        pass
print('Network connected!')
print(sta_if.ifconfig())
rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}


while True:
    if sta_if.isconnected():
        
        #*******************************************************************************
        #HTTP GET request 
        rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}
        res = requests.get(url= ip +'/sensors/C100E030/LED/GetLED.php', headers=rpi_headers)
        print(res.content.decode())
        print(ujson.loads(res.content))
        response=ujson.loads(res.content)
        print(type(response))
        print("LED RED = {}, LED GREEN = {}, LED BLUE = {}".format(response[0]['RedLED'], response[0]['GreenLED'], response[0]['BlueLED']))
        RedLED = int(response[0]['RedLED'])
        GreenLED = int(response[0]['GreenLED'])
        BlueLED = int(response[0]['BlueLED'])
        print(RedLED)
        print(GreenLED)
        print(BlueLED)
        LEDSW(RedLED, GreenLED, BlueLED)

        time.sleep(0.5)
        
        #**********************************************************************************
        #HTTP POST request
#         rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}
#         d22.measure()
#         temp=d22.temperature()
#         humidity=d22.humidity()
#         print('Temperature = {:.1f}°C'.format(temp)) # eg. 23 (°C)
#         print('Humidity = {:.1f}%'.format(humidity))    # eg. 41 (% RH)
#         querydata="Temp={:.1f}&Humidity={:.1f}".format(temp,humidity)
#         #querydata="api_key={}&field1={:.1f}&field2={:.1f}".format(W_APIKey, temp, humidity)
#         print(querydata)
#         res = requests.post(url='http://192.168.118.202/sensors/AddDataPost.php',data=querydata, headers=rpi_headers)
#         #print(res.content.decode())
#         #print(res.status_code)
#         time.sleep(5)
        #******************************************************************************
    else:
        print("not connected to AP")
