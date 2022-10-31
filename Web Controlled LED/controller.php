<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>LED Control Through Web Server</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="display-3" align="center"><b>LED Control Panel</b></h1>
        <h1 align="center"><b>劉泰佑</b></h1>
        <h1 align="center">C100E030</h1>
    </div>

    <br>    

	<div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <!----------------------------------   Action Button ---------------------------------------------------->
                <div class="card text-center">
                    <div class="card-header">
                        <div class="row bg-secondary text-white rounded card-title">
                            <figure style="padding-left: 10px;"><h4>Action</h4></figure>
                        </div>
                        <br>
                        <div class="row card-body">
                            <div class="col-3">
                                <button type="button" class="led btn btn-danger btn-lg" id="0" onclick="refreshPage();rled();">Red LED On</button> <!-- button for LED 0 -->
                            </div>
                            <div class="col-3">
                                <button type="button" class="led btn btn-success btn-lg" id="1" onclick="refreshPage();gled();">Green LED On</button> <!-- button for LED 1 -->
                            </div>
                            <div class="col-3">
                                <button type="button" class="led btn btn-primary btn-lg" id="2" onclick="refreshPage();bled();">Blue LED On</button> <!-- button for LED 2 -->
                            </div>
                            <div class="col-3">
                                <button type="button" class="led btn btn-secondary btn-lg" id="8" onclick="refreshPage();oled();">All LED Off</button> <!-- button for LEDs off -->
                            </div>
                        </div>

                        <div class="row card-body">
                            <?php
                                date_default_timezone_set("asia/taipei");
                                $dns="mysql:host=127.0.0.1;dbname=Sensors";
                                $Temp=$_GET['Temp'];
                                $Humidity=$_GET['Humidity'];

                                try{
                                        $db=new PDO($dns,'pi','raspberrypi');
                                        $db->exec("set names utf8");
                                        $sql="insert into LEDCOLOR(Temp,Humidity) values('$Temp','$Humidity');";
                                        $result=$db->exec($sql);
                                        if($result==1){
                                                echo "Update Succeed ";
                                                ?>
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <?php
                                        }else{
                                                echo "Update Fail";
                                        }
                                }catch(PDOException $e){
                                        printf("DATABASE_ERRMESG:%s",$e->getMessage());
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./LED Control thru WebServer_files/jquery-3.3.1.min.js.download">
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.led').click(function(){
				var api_key =  "W2P1P2DHF483W8VK";//Write API Key
				// get id value (i.e. LED 0, LED 1, or........)
				var field1 = $(this).attr('id'); 
				rUrl = "https://api.thingspeak.com/update?api_key="+ api_key + "&field1=" + field1;
				//rUrl = "https://api.thingspeak.com"
				// send HTTP GET request to the IP address 
				//with the value "field1",
				// then execute the function
				$.get(rUrl); // execute get request
				data={'api_key':api_key, 'field1':field1}
				$.post(rUrl,data)
			});
		});
	</script>
</body>
</html>