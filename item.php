<?php 

include_once "includes/db.inc.php";
if(!isset($_GET["itemID"])){
    header("location:index.php");
    exit();
}else{
    $items=mysqli_query($conn,"select * from items inner join categories on categories.catID=items.catID where items.itemID=".$_GET["itemID"]);
    $row=mysqli_fetch_assoc($items);
    $numberOfItems=mysqli_num_rows($items);
}

include "header.php";
echo "
<ul class='navbar-nav'>
<li class='nav-item'>
  <a class='nav-link' href='index.php'>Ana Sayfa</a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='mechanic.php'>Mekanik</a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='acces.php'>Aksesuar</a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='contact.php'>İletişim</a>
</li>
</ul>
";
include "header2.php";
?>
<!-- jQuery -->
 <div class="container">
    <div class="row">
        <div class="col-xl-12 fa-border" style="border-color:rgba(0, 0, 0, 0.4);max-height:250px !important;border-top-width: 0px;border-radius:5px;">
            <img class="img-responsive" style="max-height:100%;" src="images/banner.png" alt="#" />
        </div>
    </div>
    <?php 
    if($numberOfItems>0){
    echo "
    <!-- Ürün Varsa Buraya -->
    <div class='row'>
        <div class='col-md-12' style='margin-top:50px;margin-bottom:50px;'> 
            <form method='post'>

                <div class='row'>
                    <div class='col-md-7 product_blog form-control'>
                    
                        <img src='".$row['pic']."' alt='#' />
                    
                    </div>

                    <div class='col-md-4' style='margin-left:30px;word-wrap:break-word;'>
                        <h1 style='font-size:40px;'>".$row['item'].' '.$row['cat']."</h1>
                        <h6 style='font-size:12px;color:indianred;margin-top: -30px;font-weight:500;'>".$row['catType']. "Parça</h6>
                        <h3><span style='color: indianred !important;'>".$row['price']."</span> TL</h3>
                        <br />
                        <br />
                        <h6 style='font-weight:500;'>Ürün Bilgisi</h6>
                        <p style='color:rgba(0, 0, 0, 0.6) !important;white-space:pre-wrap;'>".$row['info']."</p>
                        <h6>Adet : <input id='cQuantity' name='cQuantity' type='text' class='h6' value='1' style='width: 35px;padding: 5px 10px;' readonly/>
                        <button class='btn-outline-danger h6' onclick='decrease();return false;' Text='-' style='outline:none;width:25px;border-radius:7px;'>-</button>
                        <button class='btn-outline-success h6' onclick='increase();return false;' Text='+' style='outline:none;width: 25px;border-radius:7px;' >+</button>
                        </h6>      
                        <br />
                        <script>
                            function labelShow()
                            {              
                                document.getElementById('addingItem').style.visibility='visible';
                                setTimeout(function (){document.getElementById('addingItem').style.visibility='hidden'},2000);
                            }
                            function decrease() {
                                var value = parseInt(document.getElementById('cQuantity').value, 10);
                                value = isNaN(value) ? 0 : value;
                                if (value > 1) {
                                    value--;
                                }
                                document.getElementById('cQuantity').value = value;
                            }
                            function increase() {
                                var value = parseInt(document.getElementById('cQuantity').value, 10);
                                value = isNaN(value) ? 0 : value;
                                if (value < 9) {
                                    value++;
                                }
                                document.getElementById('cQuantity').value = value;
                            }
                            $(document).ready(function() {
                                    $('#addItemBtn').on('click', function() {
                                    var userID = $('#userID').val();
                                    var itemID = $('#itemID').val();
                                    var quantity = $('#cQuantity').val();
                                    $.ajax({
                                        url: 'includes/item.inc.php',
                                        type: 'POST',
                                        data: {
                                            userID: userID,
                                            itemID: itemID,
                                            quantity: quantity,			
                                        },
                                    });
                                    if(document.getElementById('basketQuantity').innerHTML==''){
                                        document.getElementById('basketQuantity').innerHTML=0;
                                        document.getElementById('basketQuantity').style.display='block';
                                    }
                                    var basketQuantity = parseInt(document.getElementById('basketQuantity').innerHTML,10) + parseInt(quantity,10);
                                    document.getElementById('basketQuantity').innerHTML=basketQuantity;                          
                                });
                            });
                        </script>
                            <input type='text' id='userID' name='userID' style='display:none;' value='".$_SESSION['userID']."'>
                            <input type='text' id='itemID' name='itemID' style='display:none;' value='".$row['itemID']."'>
                        <button id='addItemBtn' type='button' name='addItem' onclick='labelShow();' class='btn-outline-warning h4' style='outline:none;border-width:1px !important;border-radius:15px !important;padding:10px 10px;'>Sepete Ekle</button>
                        <br />
                        <label id='addingItem' class='alert alert-success h5 fa-border' style='border-radius:10px;padding:10px 10px;border-color:rgba(0,0,0,0.5);visibility:hidden;'>Ürün sepete eklendi.</label>
                        <br />
                        <br />
                        <h6 style='font-weight:300;font-size:13px;color:rgba(0, 0, 0, 0.6) !important;'>Ürün No : ".$row['itemID']."</h6>
                    </div>
                </div>
            </form>
        </div>
    </div>";
    }
    else{
    echo "
    <!-- Böyle bir ürün yok Hata -->
    <div class='row'>
        <div class='col-md-12' style='margin-top:50px;margin-bottom:50px;'>
            <h1 style='font-size:48px;'>HATA</h1>
            <h3>Böyle bir ürün mevcut değil.</h3>
        </div>
    </div>";
    }
?>
</div>
<?php
include "footer.php";
?>
