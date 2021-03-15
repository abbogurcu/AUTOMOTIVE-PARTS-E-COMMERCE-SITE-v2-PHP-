<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/e-commerce-site/includes/db.inc.php";

if(!isset($_SESSION["adminLogin"])){
	header("location:login.php");
	exit();
}

if(isset($_POST['userID'])){
    mysqli_query($conn,"update users set password='".$_POST['password']."' where userID='".$_POST['userID']."'");
}


include "header.php";
echo "<ul class='navbar-nav'>
<li class='nav-item'>
  <a class='nav-link active text-red' href='password.php'>
    <i class='ni ni-lock-circle-open'></i> Şifre Değiştir
  </a>
</li>
<li class='nav-item '>
  <a class='nav-link' href='index.php'>
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
<!-- Page content -->
<div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form id="form2" method="post" role="form" >
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                    </div>
                    <input id="TextBox1" class="form-control" placeholder="Şifre" type="password" ></input>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="TextBox2" class="form-control" placeholder="Şifre Tekrar" type="password" ></input>
                  </div>
                </div>

                <div id="div1" style='display:none;' class="alert alert-success" role="alert">
                    <strong>Başarılı!</strong> Şifre değişti
                </div>

                <div id="div111" style='display:none;' class="alert alert-warning" role="alert">
                    <strong>Hata!</strong> Şifreler Uyuşmuyor
                </div>

                <div class="text-center">
                    <button id="Button" type="button" class="btn btn-primary my-4"  onclick="passwordChange();">Değiştir</button>
                </div>
              </form>

              <input id="userID" style='display:none;' ></input>
           
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
function passwordChange(){
    var userID=document.getElementById('userID').value;
    var password=document.getElementById('TextBox1').value;
    var password2=document.getElementById('TextBox2').value;
    if(password!=password2){
        document.getElementById('div111').style.display='block';
        document.getElementById('div1').style.display='none';
    }
    else{
        document.getElementById('div1').style.display='block';
        document.getElementById('div111').style.display='none';
        $.ajax({
            url:"password.php",
            type:"post",
            data:{
                userID:userID,
                password:password,
            }
        });
    }
}
</script>
</html>