<?php
include_once "db.inc.php";
mysqli_query($conn,"insert into basket(userID,itemID,quantity) values('".$_POST['userID']."','".$_POST['itemID']."','".$_POST['quantity']."')");
?>