<html>
<head>
<meta charset="utf8">
</head>
<body>
<table border=3>
<tr>
<th>ID</th>
<th>Temperature</th>
<th>Humididty</th>
<th>Time</th>
</tr>
<?php
date_default_timezone_set("asia/taipei");
$dsn='mysql:host=127.0.0.1;dbname=sensors';
try {
                $db=new PDO($dsn,'pi','raspberry');
                $db->exec("set names utf8");
        $sql="select * from DHT;";
        foreach ($db->query($sql) as $row) {
                echo "<tr>";
                echo " <td>".$row["ID"]."</td>";
                echo " <td>".$row["Temp"]."</td>";
                echo " <td>".$row["Humidity"]."</td>";
		echo " <td>".$row["Time"]."</td>";
                echo "</tr>";
        }
} catch (PDOException $e) {
        printf("DATABASER_ERRMESG: %s",$e->getMessage());
}
?>
</table>
<input type="button" value="Back" onclick="location.href='./sensor.html'">
</body>
</html>

