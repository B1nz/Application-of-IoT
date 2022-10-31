import dht,machine
import urequests as requests
import ujson, json
import time, network
#machine.Pin(14,machine.Pin.IN) #D5
#machine.Pin(4, machine.Pin.IN) #D6
#d11 = dht.DHT11(machine.Pin(14))
d22 = dht.DHT22(machine.Pin(2))
SSID="O5"
PASSWD="Password17%"
IP="http://192.168.61.202/sensors/"

# Fill in your router's ssid and password here.codey.wifi.start('wifi_ssid', 'password')

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
while True:
    if sta_if.isconnected():
        
        #*******************************************************************************
        #HTTP GET request 
        rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}
        d22.measure()
        temp=d22.temperature()
        humidity=d22.humidity()
        print('Temperature = {:.1f}°C'.format(temp)) # eg. 23 (°C)
        print('Humidity = {:.1f}%'.format(humidity))    # eg. 41 (% RH)
        querydata="Temp={:.1f}&Humidity={:.1f}".format(temp, humidity)
        print(querydata)
        res = requests.get(url='http://192.168.61.202/sensors/AddData.php?' + querydata, headers=rpi_headers)
        print("1")
        #print(res.content.decode())
        #print(res.status_code)
        time.sleep(30)
        res.close()
        
        #**********************************************************************************
        #HTTP POST request
        rpi_headers = {"Content-type": "application/x-www-form-urlencoded","Accept": "text/plain"}
        d22.measure()
        temp=d22.temperature()
        humidity=d22.humidity()
        print('Temperature = {:.1f}°C'.format(temp)) # eg. 23 (°C)
        print('Humidity = {:.1f}%'.format(humidity))    # eg. 41 (% RH)
        querydata="Temp={:.1f}&Humidity={:.1f}".format(temp,humidity)
        #querydata="api_key={}&field1={:.1f}&field2={:.1f}".format(W_APIKey, temp, humidity)
        print(querydata)
        res = requests.post(url='http://192.168.61.202/sensors/AddDataPost.php',data=querydata, headers=rpi_headers)
        print("2")
        #print(res.content.decode())
        #print(res.status_code)
        time.sleep(30)
        res.close()
        #******************************************************************************
        #HTTP POST Request with Json format
        ''' 
        rpi_headers = {"Content-type": "application/json","Accept": "text/plain"}
        d22.measure()
        temp=d22.temperature()
        humidity=d22.humidity()
        jsondata={'Temp':temp, 'Humidity':humidity}
        print(jsondata)
        res = requests.post(url='http://192.168.0.106/sensors/AddDataJson.php',data=ujson.dumps(jsondata), headers=rpi_headers)
        print(res.content.decode())
        print(res.status_code)
        time.sleep(5)
        '''
    else:
        print("not connected to AP")
