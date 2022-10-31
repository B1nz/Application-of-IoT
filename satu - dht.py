import dht,machine
from machine import Pin
import urequests as requests
import ujson 
import time, network

SSID="ASUSLAB"
PASSWD="ASUSASUS"
W_APIKey='ASDZ93A9KUV6Q9KS'
R_APIKey='H6SMUI9P8IQ76E23'
Channel_Id='1681817'
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

#DHT PIN Configuration
d22 = dht.DHT22(machine.Pin(2))
print(statusquerydata)
res1 = requests.post(url='https://api.thingspeak.com/update',data=statusquerydata, headers={"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"})
print(res1.content.decode())
print(res1.status_code)

while True:
	if sta_if.isconnected():
            rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}
            
            d22.measure()
            temp=d22.temperature()
            humidity=d22.humidity()
            print('Temperature = {:.1f}°C'.format(temp)) # eg. 23 (°C)
            print('Humidity = {:.1f}%'.format(humidity))    # eg. 41 (% RH)
            querydata2="/?api_key={}&field1={:.1f}&field2={:.1f}".format(W_APIKey, temp, humidity)
            print(querydata2)
            res2 = requests.get(url='https://api.thingspeak.com/update' + querydata2, headers=rpi_headers)
            print(res2.content.decode())
            print(res2.status_code)
            
	else:
            print("not connected to AP")