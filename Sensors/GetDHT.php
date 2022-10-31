<?php
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("asia/taipei");
	$dns="mysql:host=127.0.0.1;dbname=C100E030";
	try{
		$db=new PDO($dns,'C100E030','raspberrypi');
		$db->exec("set names utf8");
		$sql = "select Temp, Humidity, Time from DHT ORDER BY Time DESC LIMIT 1;";
		$myArray = array();
		$result=$db->query($sql);
		
		if($row=$result->fetch(PDO::FETCH_ASSOC))
		{
			$myArray[] = $row;
		}
		//echo  "\n";
		echo json_encode($myArray);
		//echo "\n";
		$db=null;
	}catch(PDOException $e){
		printf("DATABASE_ERRMESG:%s",$e->getMessage());
	}
?>	