<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Update Status</title>
</head>
<style>
    body {
        background-color:#004052;
    }
</style>
<body class="container align-middle h-100 mx-auto">
    <?php
        date_default_timezone_set("asia/taipei");
        $dns="mysql:host=127.0.0.1;dbname=C100E030";
        $Temp=$_GET['Temp'];
        $Humidity=$_GET['Humidity'];

        try{
                $db=new PDO($dns,'C100E030','raspberrypi');
                $db->exec("set names utf8");
                $sql="insert into DHT(Temp,Humidity) values('$Temp','$Humidity');";
                $result=$db->exec($sql);
                if($result==1){
                        // echo "Update Succeed ";
                        ?>
                        <h2 class="text-white">Insert Success!</h2>
                        <input type="button" class="btn" value="Back" style="background-color: #06cdef;" onclick="location.href='./th.html'"></body>
                        <?php
                }else{
                        echo "Update Fail";
                }
        }catch(PDOException $e){
                printf("DATABASE_ERRMESG:%s",$e->getMessage());
        }
        ?>
</html>