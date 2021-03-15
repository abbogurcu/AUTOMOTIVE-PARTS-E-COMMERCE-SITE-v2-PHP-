<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/e-commerce-site/includes/db.inc.php";

if(!isset($_SESSION["adminLogin"])){
	header("location:login.php");
	exit();
}

if(isset($_POST['contactID'])){
    mysqli_query($conn,"delete from `e-commerce`.contact where contactID='".$_POST['contactID']."'");
}

include "header.php";
echo "<ul class='navbar-nav'>
<li class='nav-item '>
  <a class='nav-link' href='password.php'>
    <i class='ni ni-lock-circle-open'></i> Şifre Değiştir
  </a>
</li>
<li class='nav-item '>
  <a class='nav-link active text-red' href='index.php'>
    <i class='ni ni-bell-55'></i> İletişim Kutusu
  </a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='addItem.php'>
    <i class='ni ni-image'></i> Ürün Yükle
  </a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='updateItem.php'>
    <i class='ni ni-album-2'></i> Ürün Güncelle
  </a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='orderItem.php'>
    <i class='ni ni-album-2'></i> Ürün Sipariş
  </a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='orderCargo.php'>
    <i class='ni ni-album-2'></i> Kargo
  </a>
</li>
</ul>";
include "header2.php";
?>
<style> @media (min-width:1100px){
.maxWidthGrid
{
max-width: 800px;
max-height: 500px;
overflow:scroll;
}}
@media (min-width:700px){
.maxWidthGrid
{
max-width: 700px;
max-height: 250px;
overflow:scroll;
}}
@media (max-width:480px){
.maxWidthGrid
{
max-width: 700px;
max-height: 150px;
overflow:scroll;
}}
</style>
<!-- Page content -->
<div class="col-md-12 justify-content-center" style="margin-top:-100px">
    <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5" style="margin-bottom:50px;">
            <table id='tableSiparis' border=1 style='table align-items-center table-flush border-collapse:unset;border-color:rgba(0,0,0,0.6);width:100%'>
                <tbody>
                    <tr class='border alert alert-warning h6 text-center' style='border-color:black !important;'>
                        <th style='font-size:20px;' scope='col'>Adı Soyadı</th>
                        <th style='font-size:20px;' scope='col'>Telefon</th>
                        <th style='font-size:20px;' scope='col'>Adres</th>
                        <th style='font-size:20px;' scope='col'>Mesaj</th>
                        <th style='font-size:20px;' scope='col'>Tarih</th>
                        <th style='font-size:20px;' scope='col'>Silme</th>
                    </tr>
                    <?php
                    $contactBox=mysqli_query($conn,"select * from contact");
                    $contactItemsNumber=mysqli_num_rows($contactBox);
                    while($contactItemsNumber>0){
                        $contactBoxItemRow=mysqli_fetch_assoc($contactBox);
                        echo "
                        <td style='width:150px;'>  
                            <div class='text-center h4'>
                                <label style='color:black;margin:0px 5px;'>".$contactBoxItemRow['fullName']."</label>
                            </div>
                        </td>
                        <td style='width:100px;'>  
                            <div class='text-center h3'>
                                <label style='color:black;margin:0px 5px;'>".$contactBoxItemRow['phone']."</label>
                            </div>
                        </td>
                        <td style='width:150px;'>  
                            <div class='text-center h5'>
                                <label style='color:black;margin:0px 5px;'>".$contactBoxItemRow['address']."</label>
                            </div>
                        </td>
                        <td style='width:150px;'>  
                            <div class='text-center h5'>
                                <label style='color:black;margin:0px 5px;'>".$contactBoxItemRow['message']."</label>
                            </div>
                        </td>
                        <td style='width:100px;'>  
                            <div class='text-center h3'>
                                <label style='color:black;margin:0px 5px;'>".$contactBoxItemRow['dateOfMessage']."</label>
                            </div>
                        </td>
                        <td style='width:150px;'>  
                            <div class='text-center h3'>
                                <button Class='btn btn-warning my-4' onclick='contactItemDelete(".$contactBoxItemRow['contactID'].");'>Sil</button>  
                            </div>
                        </td>";
                        --$contactItemsNumber;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>

<script>
    function contactItemDelete(contactID){
        $.ajax({
            url:"index.php",
            type:"post",
            data:{
                contactID:contactID,
            },
            success:function(){
                location.reload();
            }
        });
    }
</script>
</html>