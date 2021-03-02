<?php

include_once "db.inc.php";

if(isset($_POST["registerBtn"])){
    $userCheck=mysqli_query($conn,"select * from users where username='".$_POST['username']."'");

    if(mysqli_num_rows($userCheck)==1){
        header("location:../register.php?error=usernameexist");
        exit();
    }else{
        if(isset($_POST['username'],$_POST['password'],
        $_POST['name'],$_POST['surname'],$_POST['phone'],$_POST['address']))
        {
            mysqli_query($conn,"insert into users(username,password,name,surname,phone,address,auth) values('".$_POST['username']."','".$_POST['password']."',
            '".$_POST['name']."','".$_POST['surname']."','".$_POST['phone']."','".$_POST['address']."',0)");
            header("location:../login.php?success");
        }else{
            header("location:../register.php?error=empty");
            exit();
        }
    }
}else{
    header("location:../register.php");
}
?>