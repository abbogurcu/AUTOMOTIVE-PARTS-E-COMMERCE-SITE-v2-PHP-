<?php
include_once "db.inc.php";
if(!isset($_SESSION)){session_start();}
$itemsInBasket=mysqli_query($conn,"select * from basket inner join items on items.itemID=basket.itemID inner join categories on categories.catID=items.catID where userID='".$_SESSION['userID']."'");
$numberOfItemsType=mysqli_num_rows($itemsInBasket);
$totalPrice=0;
$KDVPrice=0;
$withoutKDV=0;

if($numberOfItemsType!=0){
    while($numberOfItemsType>0){
        $row=mysqli_fetch_assoc($itemsInBasket);
        $priceOfItems=$row['price']*$row['quantity'];
        $totalPrice+=$priceOfItems;
        $KDVPrice=$totalPrice*0.18;
        $withoutKDV=$totalPrice-$KDVPrice;
        echo "
            <div style='margin-bottom: 20px;'>
                <table id='tableSiparis' border=1 style='border-collapse:unset;border-color:rgba(0,0,0,0.6);width:100%'>
                    <tbody>
                        <td style='width:150px;'>  
                            <div class='text-center h6'>
                            <label  id='Text1' style='color:black;margin:0px 5px;'>".$row['item']." ".$row['cat']."</label>
                        </div>
                        </td>
                        <td style='width:250px;'>  
                        <div class='text-center h6'>
                            <img style='width:250px;height:auto;max-height:250px;'  src='".$row['pic']."' alt='#' />
                        </div>
                        </td>
                        <td style='width:85px;'>  
                        <div class='text-center h5' style='display:-webkit-inline-box;'>
                                <h6><button class='btn-danger h5' OnClick='decrease(".$row['itemID']."); return false;' style='outline:none;height: 30px;width:25px;border-width:unset;'>-</button>
                                <input type='text' class='h5' id='".$row['itemID']."' value='".$row['quantity']."' style='width: 35px;padding: 5px 10px;' readonly/>
                                <button class='btn-success h5'  onclick='increase(".$row['itemID']."); return false;' style='outline:none;height: 30px;width: 25px;border-width:unset;'>+</button>
                        </div>
                        <div class='text-center h6'>
                            <button  class='btn-outline-danger' onclick='deleteItem(".$row['basketID'].");' style='outline:none;margin-top: -10px;border-color: rgba(255,0,0,0.5);padding: 3px 5px;border-radius: 15px; font-weight: 400;'><img src='images/trash.png' style='width:20px;height:auto;'/> Kaldır</button>
                        </div>
                        </td>
                        <td style='width:85px;'>  
                        <div class='text-center h6'>
                            <label id='".$row['itemID']."' style='color:black;margin:0px 5px;'>".$priceOfItems."</label> TL
                        </div>
                        </td>
                    </tbody>
                </table>
            </div>";
        --$numberOfItemsType;
    }
    echo "
    <button id='deleteItemsBtn' class='btn-outline-danger h5' style='border-width:1px !important;border-radius:15px !important;padding:10px 10px;outline:none;'>Sepeti Boşalt</button>
    <input type='text' id='userID' name='userID' style='display:none;' value='".$_SESSION['userID']."'>
    </div>
    <div class='col-md-4'>
        <div class='col-md-12'style='margin-top:50px;background-color:white;max-width: 333px;float:right;margin-bottom:50px;padding-bottom:10px;box-shadow: 0 2px 4px 0 rgba(0,0,0,.4);'>
            <h3 style='margin-top:20px;'>Adreslerim</h3>

            ";
            if(!is_numeric($_SESSION['userID'])){
                echo "
                <div id='div5'  style='width: 300px;'>
                    <div style='width: 300px;'>
                        <label CssClass='h6' style='color:black;'>Adres :</label>
                        <textarea id='TextArea4' class='form-control h6' placeholder='Yeni adresinizi girin!'  style='max-width:240px;float:right;margin-left:5px;padding-bottom:100px;'></textarea>
                    </div>
                </div>";
            }
            else{
            echo "
            <div style='width:300px;' id='div6' >
                <div style='display:-webkit-inline-box;margin-top:20px'>
                    <label class='h6' style='color:black;'>Adres :</label>
                    <select class='form-control h6' id='selectAddress' style='max-width:250px;padding-bottom: 5px;margin-top: -8px;margin-left:5px;'>";

                    $address=mysqli_query($conn,"select * from address where userID=".$_SESSION["userID"]);
                    $numberOfAddresses=mysqli_num_rows($address);
                    while($numberOfAddresses>0){
                        $row2=mysqli_fetch_assoc($address);
                        echo "<option value='".$row2['addressID']."'>".$row2['address']."</option>";
                        --$numberOfAddresses;
                    }

                    echo "</select>
                </div>
                    <textarea readonly id='TextArea3' class='form-control h6'  style='max-width:250px;padding-bottom:100px;margin-left:60px;'></textarea>
                        <h6><a href='profile.php?address=1'><button class='fa-border text-center btn-outline-success' style='max-width:250px;float:right;margin-right:-10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
                Yeni Adres Ekle<button></a></h6>
            </div>";}
        $totalNumberOfItems=mysqli_query($conn,"select SUM(quantity) as quantities from basket where userID='".$_SESSION['userID']."'");
        $totalNumberOfItemsRows=mysqli_fetch_assoc($totalNumberOfItems);     
        echo 
        "</div>
        <div class='col-md-12' style='background-color:white;max-width: 333px;float:right;margin-bottom:50px;padding-bottom:10px;box-shadow: 0 2px 4px 0 rgba(0,0,0,.4);'>
            <h3 style='margin-top:20px;'>Sipariş Özeti</h3>
            <br />
            <br />
            <h5 style='font-weight: 300'>Sepetinizde <label class='h6' style='font-weight: 600;'>".$totalNumberOfItemsRows['quantities']."</label> adet ürün mevcut.</h5>
            <br />
            <h5 style='font-weight: 400'>Fiyat (KDV'siz) :  <label class='h6' style='font-weight: 600;'>".$withoutKDV."</label> TL</h5>
            <h5 style='font-weight: 400'>KDV :  <label class='h6' style='font-weight: 600;'>".$KDVPrice."</label> TL</h5>
            <h5 style='font-weight: 400'>Toplam : <label class='h6' style='font-weight: 600;'>".$totalPrice."</label> TL</h5>
            <br />
            <label class='p' style='color:black;'><input id='CheckBox1' class='checkmark' type='checkbox' name='colorCheckbox'  value='check'><label style='padding-left:30px;' class='p'>Sözleşmeyi</label> <button type='button' style='outline:none;padding: 2px;border-radius: 20px;border-width:unset;border-bottom-width:1px;border-color: rgba(0,0,0,0.3);' onclick='showSozlesme();return false;' class='h6 fa-border text-center btn-outline-primary'>okudum</button> , kabul ediyorum.</label>
            <br />
            <br />
            <h4><button ID='buyBtn' type='button' class='fa-border text-center btn-outline-success' OnClick='return false;' style='outline:none;padding:5px 10px;width: 100%;border-radius: 20px;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
            Satın Al<button></h4>
            <div class='text-center' >
                <strong>
                    <label ID='Label1' Class='alert alert-danger h6' style='display:none;'>Adres boş geçilemez.</label>
                    <label ID='Label2' Class='alert alert-danger h6' style='display:none;'>Lütfen sözleşmeyi okuduktan sonra onaylayınız.</label>
                </strong>
            </div>
        </div>
    </div>
    ";
}
else{
    $getOrderNoForGuest=mysqli_query($conn,"select DISTINCT orderNo,dateOfOrder from `e-commerce`.order where userID='".$_SESSION["userID"]."' order by dateOfOrder desc");

    echo "<h4 class='alert alert-warning fa-border' style='border-radius:40px;border-color:rgba(0,0,0,0.5);margin:50px 0px;'>Sepetiniz boş. Alışverişinize <a href='index.php'><span>buraya</span></a> tıklayarak devam edebilirsiniz.</h4>";                    
    if(is_numeric($_SESSION['userID'])){
        echo "<div class='col-md-12' id='sepetSiparis' style='margin-top:10px;padding:50px 50px;box-shadow: 0 2px 4px 0 rgba(0,0,0,1);background-color:#fff;' >
            <h2>Geçmiş Sipariş Bilgileri</h2>
            ";
            $lastGuestOrder=mysqli_num_rows($getOrderNoForGuest);
            if($lastGuestOrder>5){
                $lastGuestOrder=5;
            }
            while($lastGuestOrder>0){
                --$lastGuestOrder;
                $guestOrderNo = mysqli_fetch_assoc($getOrderNoForGuest);
                echo "<div style='display: -webkit-inline-box;'>
                Sipariş No : <h6 style='margin-left:5px;margin-top:2px;'>".$guestOrderNo['orderNo']."</h6> <h2 style='padding: 0px 25px;margin-top: -5px;'>----></h2> Sipariş Tarihi : <h6 style='margin-left:5px;margin-top:2px;'>".$guestOrderNo['dateOfOrder']."</h6>
                </div><br />";
            }
    }else{
        echo "
            <h5 style='padding: 0px 3%;'>Sipariş numaralarıyla misafir sipariş sorgu ekranından bilgi alabilirsiniz. Bilgi almak için <a href='guestOrder.php'><button type='button' style='outline:none;padding: 2px;border-radius: 20px;border-width:unset;border-bottom-width:1px;border-color: rgba(0,0,0,0.3);' class='h6 fa-border text-center btn-outline-primary'>buraya</button></a> tıklayınız.</h5>
            </div>
            <br />";
    }
}
?>
<script>
$(document).ready(function() {
    $('#deleteItemsBtn').on('click', function() {
        var userID = $('#userID').val();
        $.ajax({
            url: 'includes/basket.inc.php',
            type: 'POST',
            data: {
                userID: userID,		
            },
            success: function()
            {
                location.reload();
            }
        });
    });

    $('#buyBtn').on('click', function() {
        var setAddress=1;
        var userID = $('#userID').val();
        if(document.getElementById("CheckBox1").checked==true){
            // Sipariş veriliyor...
            if(isNaN(userID)){
                var address = $('#TextArea4').val();    
                if(address!=''){
                    $.ajax({
                        url: 'includes/basket.inc.php',
                        type: 'POST',
                        data: {
                            setAddress:setAddress,
                            userID: userID,
                            address:address,
                        },
                        success:function (){
                            location.reload();
                        }
                    });
                }else{
                    document.getElementById('Label1').style.display='block';
                    setTimeout(function (){document.getElementById('Label1').style.display='none'},2000);
                }
            }
            else{
                var address = $('#TextArea3').val();    
                if(address!=''){
                    $.ajax({
                        url: 'includes/basket.inc.php',
                        type: 'POST',
                        data: {
                            setAddress:setAddress,
                            userID: userID,
                            address:address,
                        },
                        success:function (){
                            location.reload();
                        }
                    });
                }else{
                    document.getElementById('Label1').style.display='block';
                    setTimeout(function (){document.getElementById('Label1').style.display='none'},2000);
                }
            }
        }
        else{
            document.getElementById('Label2').style.display='block';
            setTimeout(function (){document.getElementById('Label2').style.display='none'},2000);
        }
        /*
       */
    });

    onSelected();

    $('#selectAddress').on('change', function() {
        onSelected();
    });

    function onSelected(){
        var addressID = $('#selectAddress').val();        
        $.ajax({
            url: 'includes/basket.inc.php',
            type: 'POST',
            dataType:'json',
            data: {
                addressID: addressID,		
            },
            success: function(data)
            {
                $('#TextArea3').html(data.fullAddress);
            }
        });
    }
});

function showSozlesme() {
    document.getElementById("myModal").style.display = "block";
}

var span = document.getElementsByClassName("close")[0];

span.onclick = function () {
    document.getElementById("myModal").style.display = "none";
}

function increase(itemID){
    var value = parseInt(document.getElementById(itemID).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value < 9) {
        value++;
        document.getElementById(itemID).value = value;

        var userID=document.getElementById('userID').value;
        var quantity=document.getElementById(itemID).value;
        $.ajax({
            url: 'includes/itemIncDecBasket.inc.php',
            type: 'POST',
            data: {
                increase:1,
                itemID:itemID,
                userID:userID,
                quantity:quantity,	
            },
            success: function()
            {
                location.reload();
            }
        });
    }
}

function decrease(itemID) {
    var value = parseInt(document.getElementById(itemID).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
        value--;
        document.getElementById(itemID).value = value;
    
        var userID=document.getElementById('userID').value;
        var quantity=document.getElementById(itemID).value;
        $.ajax({
            url: 'includes/itemIncDecBasket.inc.php',
            type: 'POST',
            data: {
                decrease:1,
                itemID:itemID,
                userID:userID,
                quantity:quantity,	
            },
            success: function()
            {
                location.reload();
            }
        });
    }
}

function deleteItem(basketID) {
    $.ajax({
        url: 'includes/itemIncDecBasket.inc.php',
        type: 'POST',
        data: {
            basketID:basketID,
        },
        success: function()
        {
            location.reload();
        }
    });
}
</script>
