<?php
	header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set("asia/taipei");
	$dns="mysql:host=127.0.0.1;dbname=C100E030";
	try{
		$db=new PDO($dns,'C100E030','raspberrypi');
		$db->exec("set names utf8");
		$sql = "select RedLED,GreenLED,BlueLED from LEDCOLOR ORDER BY Time ASC LIMIT 1;";
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

        // print json_encode($data);
	}catch(PDOException $e){
		printf("DATABASE_ERRMESG:%s",$e->getMessage());
	}
?>	