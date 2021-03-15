<?php
include "db.inc.php";

if(isset($_POST['fullName'])&&isset($_POST['phone'])&&isset($_POST['address'])&&isset($_POST['message']))
    mysqli_query($conn,"insert into contact(fullName,phone,address,message,dateOfMessage) values('".$_POST['fullName']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['message']."',date_format(date(NOW()),'%d.%m.%Y'))");

?>