<?php
include "db.inc.php";

if(isset($_POST['basketQuantity'])){
    $result=mysqli_query($conn,"select SUM(quantity) as quantities from basket where userID='".$_POST['userID']."'");
    $cust = mysqli_fetch_assoc($result);
    if($cust) {
    echo json_encode($cust);
    }
}

if(isset($_POST["userID"])&&!isset($_POST["setAddress"])&&!isset($_POST['basketQuantity'])&&!isset($_POST['message']))
    mysqli_query($conn,"delete from basket where userID='".$_POST['userID']."'");

if(isset($_POST["addressID"])){
    $result=mysqli_query($conn,"select fullAddress from address where addressID='".$_POST['addressID']."'");
    $cust = mysqli_fetch_assoc($result);
    if($cust) {
    echo json_encode($cust);
    }
}

if(isset($_POST["setAddress"])){
    $orderNo=0;
    $hasOrderNo=1;

    while($hasOrderNo>0){
        ++$orderNo;
        $result=mysqli_query($conn,"select orderNo from `e-commerce`.order where orderNo='".$orderNo."'");    
        $hasOrderNo=mysqli_num_rows($result);
    }

    $basketItems=mysqli_query($conn,"select * from `e-commerce`.basket where userID='".$_POST['userID']."'");    
    $numberOfItemsInBasket=mysqli_num_rows($basketItems);
    while($numberOfItemsInBasket>0){
        --$numberOfItemsInBasket;
        $basketItem=mysqli_fetch_assoc($basketItems);
        mysqli_query($conn,"insert into `e-commerce`.order(orderNo,userID,itemID,quantity,fullAddress,dateOfOrder) values('".$orderNo."','".$_POST['userID']."','".$basketItem["itemID"]."','".$basketItem["quantity"]."','".$_POST['address']."',date_format(date(NOW()),'%d.%m.%Y'))");
    }
    mysqli_query($conn,"delete from basket where userID='".$_POST['userID']."'");
}
?>