<?php
include 'includes/db.inc.php';

if(!isset($_SESSION)){session_start();}
if(!is_numeric($_SESSION['userID']))
    header('location:login.php');

    //$fullOrder = mysqli_query($conn,"select DISTINCT * from `e-commerce`.order where userID='".$_SESSION['userID']."' and STR_TO_DATE(dateOfOrder,'%d.%m.%Y')>date_add(date(now()),interval -1 month) group by orderNo order by dateOfOrder desc");
//$fullOrder = mysqli_query($conn,"select DISTINCT * from `e-commerce`.order where userID='".$_SESSION['userID']."' and STR_TO_DATE(dateOfOrder,'%d.%m.%Y')>date_add(date(now()),interval -12 month) group by orderNo order by dateOfOrder desc");
?>

<div style='float:right;display:-webkit-inline-box;margin-top:30px;'>
    <div class='h6' style='padding-top: 8px;margin-right:5px;'>Tarihe Göre Listele :</div>
        <div class='dropdown h6'>
        <button id='selectedDateForOrder' class='fa-border text-center btn-danger dropdown-toggle h6' style='padding:5px 5px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);'  type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Tümü
        </button>
            <div class='dropdown-menu float-right' aria-labelledby='dropdownMenu2' style='margin-top: -8px;border-radius: 15px;'>
                <button id='monthBtn' onClick='visualizeOrders(1);' class='dropdown-item h6'>Son 30 Gün</button>
                <button id='yearBtn' onClick='visualizeOrders(2);' class='dropdown-item h6'>Son 1 Yıl</button>
                <button id='allBtn' onClick='visualizeOrders(3);'class='dropdown-item h6'>Tümü</button>    
            </div>
        </div>
    </div>
    
<div style='margin-top:100px;'>

    <div id='all'>
        <?php include "includes/orderAll.inc.php";?>
    </div>

    <div id='year' style='display:none;'>
        <?php include "includes/orderLastOneYear.inc.php";?>
    </div>

    <div id='month' style='display:none;'>
        <?php include "includes/orderLastOneMonth.inc.php";?>
    </div>

</div>

<script>
    function visualizeOrders(a){
        if(a==1){
            document.getElementById('selectedDateForOrder').innerHTML=document.getElementById('monthBtn').innerHTML;
            document.getElementById('all').style.display='none';
            document.getElementById('year').style.display='none';
            document.getElementById('month').style.display='block';
        }else if(a==2){
            document.getElementById('selectedDateForOrder').innerHTML=document.getElementById('yearBtn').innerHTML;
            document.getElementById('all').style.display='none';
            document.getElementById('year').style.display='block';
            document.getElementById('month').style.display='none';
        }else{
            document.getElementById('selectedDateForOrder').innerHTML=document.getElementById('allBtn').innerHTML;
            document.getElementById('all').style.display='block';
            document.getElementById('year').style.display='none';
            document.getElementById('month').style.display='none';
        }
    }
</script>