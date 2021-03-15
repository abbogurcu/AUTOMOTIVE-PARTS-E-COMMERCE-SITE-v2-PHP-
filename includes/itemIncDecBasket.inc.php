<?php
include "db.inc.php";
mysqli_query($conn,"delete from basket where STR_TO_DATE(dateOfAdding,'%d.%m.%Y')<date_add(date(now()),interval -3 day)");

if(isset($_POST['basketID'])){
    mysqli_query($conn,"delete from basket where basketID='".$_POST['basketID']."'");
}

if(isset($_POST['increase'])||isset($_POST['decrease'])){
    mysqli_query($conn,"update basket set quantity='".($_POST['quantity'])."',dateOfAdding=date_format(date(NOW()),'%d.%m.%Y') where userID='".$_POST['userID']."' and itemID='".$_POST['itemID']."'");
}

?>