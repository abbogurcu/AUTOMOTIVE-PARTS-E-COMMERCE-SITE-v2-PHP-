<?php

session_start();
include_once "db.inc.php";

if(isset($_POST["loginBtn"])){
    $userCheck=mysqli_query($conn,"select * from users where username='".$_POST['username']."' and password='".$_POST['password']."'");

    if(mysqli_num_rows($userCheck)==0){
        header("location:../login.php?error");
        exit();
    }else{
        header("location:../index.php");
        $row=mysqli_fetch_assoc($userCheck);
        $_SESSION["userID"]=$row["userID"];
        $_SESSION["namesurname"]=$row["name"].' '.$row["surname"];
        exit();
    }
}else{
    header("location:../login.php");
    exit();
}
?>