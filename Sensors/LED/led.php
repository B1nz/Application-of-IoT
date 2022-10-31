<?php
date_default_timezone_set("asia/taipei");
$dns="mysql:host=127.0.0.1;dbname=C100E030";
$redled=$_GET['RL'];
$greenled=$_GET['GL'];
$blueled=$_GET['BL'];
$allled=$_GET['AL'];
$dhtcolor=$_GET['DC'];

	try{
		$db=new PDO($dns,'C100E030','raspberrypi');
		$db->exec("set names utf8");
		
		if($redled != ""){
			$sql="UPDATE LEDCOLOR SET RedLED='".$redled."';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(RedLED) values('$redled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}

        elseif($greenled != ""){
			$sql="UPDATE LEDCOLOR SET GreenLED='$greenled';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(GreenLED) values('$greenled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}

        elseif($blueled != ""){
			$sql="UPDATE LEDCOLOR SET BlueLED='$blueled';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(BlueLED) values('$blueled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}

        elseif($allled != ""){
			$sql="UPDATE LEDCOLOR SET RedLED='".$allled."', GreenLED='".$allled."', BlueLED='".$allled."';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(RedLED,GreenLED,BlueLED) values('$redled,$greenled,$blueled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}

        elseif($dhtcolor == "0"){
			$sql="UPDATE LEDCOLOR SET RedLED='1', GreenLED='0', BlueLED='0';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(RedLED,GreenLED,BlueLED) values('$redled,$greenled,$blueled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}

        elseif($dhtcolor == "1"){
			$sql="UPDATE LEDCOLOR SET RedLED='0', GreenLED='1', BlueLED='0';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(RedLED,GreenLED,BlueLED) values('$redled,$greenled,$blueled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}

        elseif($dhtcolor == "2"){
			$sql="UPDATE LEDCOLOR SET RedLED='0', GreenLED='0', BlueLED='1';";
			$result=$db->exec($sql);
			echo $sql."\n";
			if ($result==1)
				echo "Switch Update OK\n";
			else
			{	
				$sql="INSERT into LEDCOLOR(RedLED,GreenLED,BlueLED) values('$redled,$greenled,$blueled');";
				$result=$db->exec($sql);
				if ($result==1)
					echo "SMARTSW Update OK\n";
				else
					echo "SMARTSW Update ERROR\n";
			}			
		}
	
		$db=null;

	}catch(PDOException $e){
		printf("DATABASE_ERRMESG:%s",$e->getMessage());
	}
?>