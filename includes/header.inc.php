<?php
if(isset($_POST["logoutBtn"])){
    session_start();
    session_destroy();
    header("location:../index.php");
    exit();
}else{
    header("location:../index.php");
    exit();
}
?>