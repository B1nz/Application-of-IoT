import dht,machine
from machine import Pin
import urequests as requests
import ujson 
import time, network

SSID="Qing Shuo"
PASSWD="Staycation100%_"
W_APIKey='W2P1P2DHF483W8VK'
R_APIKey='QN4C69GIT079VIXB'
Channel_Id='1688112'
# Fill in your router's ssid and password here.codey.wifi.start('wifi_ssid', 'password')
# https://api.thingspeak.com/channels/XXXXXX/feeds.json?api_key=XXXXXXXXXXXXXXXXX&results=1
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

ledR =  Pin(0, Pin.OUT)
ledG =  Pin(5, Pin.OUT)
ledB =  Pin(4, Pin.OUT)

rstat = 0
gstat = 0
bstat = 0

def LEDSW(color):
    if color == 0:
        ledR.value(1=)
    elif color == 1:
        ledG.value(1)
    elif color == 2:
        ledB.value(1)
    elif color == 8:
        ledR.value(0)
        ledG.value(0)
        ledB.value(0)

statusquerydata="api_key={}&field2={}&field3={}&field4={}".format(W_APIKey, ledR.value(), ledG.value(), ledB.value())
print(statusquerydata)
res1 = requests.post(url='https://api.thingspeak.com/update',data=statusquerydata, headers={"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"})
print(res1.content.decode())
print(res1.status_code)

while True:
	if sta_if.isconnected():
            rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}

            #querydata="Temp={:.1f}&Humidity={:.1f}".format(temp,humidity)
            querydata="/channels/{}/feeds.json?api_key={}&results=1".format(Channel_Id, R_APIKey)
            print(querydata)
            res = requests.get(url='https://api.thingspeak.com' + querydata, headers=rpi_headers)
            print("status = ",res.status_code)
            print(res.content)
            print(res.content.decode())
            print(ujson.loads(res.content))
            response=ujson.loads(res.content)
            print(type(response))
            print("LED Status = {}".format(response['feeds'][0]['field1']))
            led="{}".format(response['feeds'][0]['field1'])
            if(led.isdigit() == 1):
                LEDSW(int("{}".format(response['feeds'][0]['field1'])))
                #time.sleep(10)
                #post status led
                statusquerydata="api_key={}&field2={}&field3={}&field4={}".format(W_APIKey, ledR.value(), ledG.value(), ledB.value())
                print(statusquerydata)
                res1 = requests.post(url='https://api.thingspeak.com/update',data=statusquerydata, headers=rpi_headers)
                print(res1.content.decode())
                print(res1.status_code)
            
	else:
            print("not connected to AP")