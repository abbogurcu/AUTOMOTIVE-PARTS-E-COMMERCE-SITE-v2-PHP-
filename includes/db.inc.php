<?php 
    $host="localhost:3306";
    $user="root";
    $password="";
    $db="e-commerce";

    $conn=mysqli_connect($host,$user,$password,$db);
    
    if(!$conn){
        die("Veritabanı hatası : ".mysqli_connect_error());
    }
?>