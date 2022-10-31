<?php
date_default_timezone_set("asia/taipei");
$dns="mysql:host=127.0.0.1;dbname=C100E030";
$Temp=$_POST['Temp'];
$Humidity=$_POST['Humidity'];

try{
        $db=new PDO($dns,'C100E030','raspberrypi');
        $db->exec("set names utf8");
        $sql="insert into DHT(Temp,Humidity) values('$Temp','$Humidity');";
        $result=$db->exec($sql);
        if($result==1){
                echo "Update Succeed ";
        }else{
                echo "Update Fail";
        }
}catch(PDOException $e){
        printf("DATABASE_ERRMESG:%s",$e->getMessage());
}
?>
