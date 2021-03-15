<?php
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
<li class='nav-item active'>
  <a class='nav-link' href='contact.php'>İletişim</a>
</li>
</ul>
";
include "header2.php";
?>

<div style="background-color:#ebebeb;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 fa-border" style="border-color:rgba(0, 0, 0, 0.4);max-height:250px !important;border-top-width: 0px;border-radius:5px;">
                <img class="img-responsive" style="max-height:100%;" src="images/banner.png" alt="#" />
            </div>
        </div>
        <div class="row justify-content-between" style="margin:50px 0px;box-shadow: 0 2px 4px 0 rgba(0,0,0,.6);background-color:#fff;">
            <div class="col-md-4" style="margin:50px 0px;">
                <h3>İletişim Formu</h3>
                <br />

                <div style="display:flow-root;" class="h6">Ad-Soyad : <input type='text' ID="adsoyad" class="form-control h6"  style="margin-top: -8px;max-width:240px;margin-left:5px;float:right;"></input></div>
                <div style="display:flow-root;" class="h6">Telefon : <input type='text' ID="telefon" class="form-control h6"  style="margin-top: -8px;max-width:240px;margin-left:5px;float:right;"></input></div>
                <div style="display:flow-root;" class="h6">Adres : <textarea id="adres" class="form-control h6"  style="margin-top: -8px;max-width:240px;margin-left:5px;padding-bottom:100px;float:right;"></textarea></div>
                <div style="display:flow-root;" class="h6">Mesaj : <textarea id="mesaj" class="form-control h6"  style="margin-top: -8px;max-width:240px;margin-left:5px;padding-bottom:100px;float:right;"></textarea></div>
                
                <h6><button onclick="sendForm();return false;" class="fa-border text-center btn-success" style="outline:none;margin-top: 10px;margin-left:15px;width:240px;float: right;border-radius: 20px;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);" >
                Yolla</button></h6>
                <br />
                <br />
                <br />
                <div class="text-center" >
                    <strong>
                        <label ID="Label1" class="alert alert-danger" style="display:none;">Ad-Soyad boş bırakılamaz.</label>
                        <label ID="Label2" class="alert alert-danger" style="display:none;">Telefon boş bırakılamaz.</label>
                        <label ID="Label3" class="alert alert-danger" style="display:none;">Adres boş bırakılamaz.</label>
                        <label ID="Label4" class="alert alert-danger" style="display:none;">Mesaj boş bırakılamaz.</label>
                        <label ID="Label5" class="alert alert-success" style="display:none;">Başarıyla iletildi.</label>
                    </strong>
                </div>
            </div>
            <div class="col-md-8" style="margin:50px 0px;border-radius:50px;display:block;margin-left:auto;margin-right:auto;">
                <iframe class="fa-border" style="border-color:rgba(0,0,0,0.5);border-radius: 30px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12453.303520950165!2d35.5336511!3d38.7103265!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc6e55fc623330b00!2zRXJjaXllcyDDnG5pdmVyc2l0ZXNp4oCL!5e0!3m2!1str!2str!4v1605399419903!5m2!1str!2str" width="700" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script>
function sendForm() {
    var adsoyad=document.getElementById("adsoyad").value;
    var telefon=document.getElementById("telefon").value;
    var adres=document.getElementById("adres").value;
    var mesaj = document.getElementById("mesaj").value;
    if (adsoyad == "") {
        setTimeout(function sifre() { document.getElementById("Label1").style.display = "block"; }, 100);
        setTimeout(function sifre() { document.getElementById("Label1").style.display = "none"; }, 3000);
    } else {
        if (telefon == "") {
            setTimeout(function sifre() { document.getElementById("Label2").style.display = "block"; }, 100);
            setTimeout(function sifre() { document.getElementById("Label2").style.display = "none"; }, 3000);
        } else {
            if (adres == "") {
                setTimeout(function sifre() { document.getElementById("Label3").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label3").style.display = "none"; }, 3000);
            } else {
                if (mesaj == "") {
                    setTimeout(function sifre() { document.getElementById("Label4").style.display = "block"; }, 100);
                    setTimeout(function sifre() { document.getElementById("Label4").style.display = "none"; }, 3000);
                } else {
                    $.ajax({
                        url: 'includes/contact.inc.php',
                        type: 'POST',
                        data: {
                            fullName:adsoyad,
                            phone:telefon,
                            address:adres,
                            message:mesaj,		
                        },
                        success:function(){
                            setTimeout(function sifre() { document.getElementById("Label5").style.display = "block"; }, 100);
                            setTimeout(function sifre() { document.getElementById("Label5").style.display = "none"; }, 5000);
                            setTimeout(function sifre() { window.location.href = "index.php"; }, 6000);
                        }
                    });
                }
            }
        }
    }
}
</script>
<?php
include "footer.php";
?>