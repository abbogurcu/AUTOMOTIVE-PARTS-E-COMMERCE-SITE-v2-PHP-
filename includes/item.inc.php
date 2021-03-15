<?php
include_once "db.inc.php";
mysqli_query($conn,"delete from basket where STR_TO_DATE(dateOfAdding,'%d.%m.%Y')<date_add(date(now()),interval -3 day)");

if(isset($_POST['userID'])&&isset($_POST['itemID'])&&isset($_POST['quantity'])){
    $quantityOfItemInBasket=mysqli_query($conn,"select quantity from basket where userID='".$_POST['userID']."' and itemID='".$_POST['itemID']."'");
    if(mysqli_num_rows($quantityOfItemInBasket)>0){
        $quantityOfItemInBasketRow=mysqli_fetch_assoc($quantityOfItemInBasket);
        mysqli_query($conn,"update basket set quantity='".($quantityOfItemInBasketRow['quantity']+$_POST['quantity'])."',dateOfAdding=date_format(date(NOW()),'%d.%m.%Y')where userID='".$_POST['userID']."' and itemID='".$_POST['itemID']."'");
    }else{
        mysqli_query($conn,"insert into basket(userID,itemID,quantity,dateOfAdding) values('".$_POST['userID']."','".$_POST['itemID']."','".$_POST['quantity']."',date_format(date(NOW()),'%d.%m.%Y'))");
    }
}
?>