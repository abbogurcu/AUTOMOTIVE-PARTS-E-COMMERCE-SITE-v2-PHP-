<?php
include "db.inc.php";
if(isset($_POST["userID"])&&isset($_POST["password"])){
    mysqli_query($conn,"update users set password='".$_POST['password']."' where userID='".$_POST['userID']."'");
}

if(isset($_POST["userID"])&&isset($_POST["name"])){
    mysqli_query($conn,"update users set name='".$_POST['name']."' where userID='".$_POST['userID']."'");
}

if(isset($_POST["userID"])&&isset($_POST["surname"])){
    mysqli_query($conn,"update users set surname='".$_POST['surname']."' where userID='".$_POST['userID']."'");
}

if(isset($_POST["userID"])&&isset($_POST["phone"])){
    mysqli_query($conn,"update users set phone='".$_POST['phone']."' where userID='".$_POST['userID']."'");
}

if(isset($_POST["addressID"])&&!isset($_POST["updateAddress"])&&!isset($_POST["insertAddress"])){
    mysqli_query($conn,"delete from address where addressID='".$_POST['addressID']."'");
}

if(isset($_POST["addressID"])&&isset($_POST["updateAddress"])){
    mysqli_query($conn,"update address set address='".$_POST["fullAddress"]."',fullAddress='".$_POST["address"]."' where addressID='".$_POST['addressID']."'");
}

if(isset($_POST['userID'])&&isset($_POST["fullAddress"])&&isset($_POST["address"])){
    mysqli_query($conn,"insert into address(address,fullAddress,userID) values('".$_POST['address']."','".$_POST['fullAddress']."','".$_POST['userID']."')");
    $result=mysqli_query($conn,"select addressID from address where address='".$_POST['address']."' and fullAddress='".$_POST['fullAddress']."' and userID='".$_POST['userID']."'");
    $cust = mysqli_fetch_assoc($result);
    if($cust) {
    echo json_encode($cust);
    }
}
?>