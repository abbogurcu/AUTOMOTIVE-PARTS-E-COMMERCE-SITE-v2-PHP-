<?php
if(isset($_POST["logoutBtn"])){
    session_start();
    session_destroy();
    header("location:../index.php");
    $_SESSION["userID"]=session_id();
    exit();
}else{
    header("location:../index.php");
    exit();
}
?>