<?php

session_start();
include $_SERVER['DOCUMENT_ROOT']."/e-commerce-site/includes/db.inc.php";

if(isset($_POST["adminLogin"])){
    $userCheck=mysqli_query($conn,"select * from users where username='".$_POST['username']."' and password='".$_POST['password']."' and auth=1");

    if(mysqli_num_rows($userCheck)==0){
        header("location:../Login.php?error");
        exit();
    }else{
        header("location:../index.php");
        $row=mysqli_fetch_assoc($userCheck);
        $_SESSION["adminLogin"]=1;
        $_SESSION["userID"]=$row['userID'];
        exit();
    }
}else{
    header("location:../Login.php");
    exit();
}
?>