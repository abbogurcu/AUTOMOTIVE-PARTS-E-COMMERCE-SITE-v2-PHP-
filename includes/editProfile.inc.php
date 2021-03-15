<?php
// USER ID
echo "<input type='text' id='userIDD' style='display:none;' value='".$_SESSION['userID']."'/>";
?>

<!-- Şifre Değiştirme -->
<div style='display: -webkit-inline-box;width:300px;' id='sifre' >
    <label class='p' style='color:black;'>Şifre :</label>
    <?php 
    include "db.inc.php";
    $userInfo=mysqli_query($conn,"select * from users where userID='".$_SESSION["userID"]."' and auth=0");
    $userInfoRows=mysqli_fetch_assoc($userInfo);
    echo "<label style='margin-left:5px;color:black;display:none;margin-top: 4px;' type='password' ID='sifreLabel' class='h6' >".$userInfoRows['password']."</label>";
    ?>
    <h6><button ID='sifreGoster' onclick='sifreGoster(1);return false;' class='fa-border text-center btn-primary btn-profile' >
Göster</button></h6>
    <h6><button ID='sifreSakla' onclick='sifreGoster(2);return false;' class='fa-border text-center btn-secondary btn-profile' style='display:none;' >
Sakla</button></h6>
    <h6><button onclick='sifre(1);return false;' class='fa-border text-center btn-outline-primary btn-profile' style='margin-left:25px;' >
Güncelle</button></h6>
</div>
<div id='sifre2'  style='width: 300px;display:none;'>
    <input type='text' ID='password' placeholder='Yeni şifrenizi girin!' class='form-control' ></input>
    <div style='display:-webkit-inline-box'>
        <input type='text' ID='password2' placeholder='Yeni şifrenizin tekrarını girin!' class='form-control' ></input>
        <h6><button onclick='sifre(3);return false;' class='fa-border text-center btn-outline-success btn-profile' >
    Onayla</button></h6>
        <h6><button onclick='sifre(2);return false;' class='fa-border text-center btn-outline-danger btn-profile' >
    İptal</button></h6>
    </div>
</div>
<div class='text-center'>
    <strong>
        <label ID='Label2' class='alert alert-danger' style='display:none;'>Şifreler uyuşmuyordu.</label>
        <label ID='Label3' class='alert alert-danger' style='display:none;'>Alan boş bırakıldı.</label>
        <label ID='Label1' class='alert alert-success' style='display:none;'>Şifre başarıyla değişti.</label>
    </strong>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<script>
    function sifreGoster(a) {
        if (a == 1) {
            document.getElementById("sifreLabel").style.display = "block";
            document.getElementById("sifreSakla").style.display = "inline-block";
            document.getElementById("sifreGoster").style.display = "none";
        } else {
            document.getElementById("sifreLabel").style.display = "none";
            document.getElementById("sifreSakla").style.display = "none";
            document.getElementById("sifreGoster").style.display = "inline-block";
        }
    }

    function sifre(a) {
        var sifre = document.getElementById("sifre");
        var sifre2 = document.getElementById("sifre2");

        if (a == 1) {
            sifre.style.display = "none";
            sifre2.style.display = "block";
        } else if (a == 2) {
            sifre.style.display = "-webkit-inline-box";
            sifre2.style.display = "none";
        } else if (a == 3) {
            sifre.style.display = "-webkit-inline-box";
            sifre2.style.display = "none";
            var password = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var userID=document.getElementById('userIDD').value;
            if (password == password2 && password != "" && password2 != "") {     
                setTimeout(function sifre() { document.getElementById("Label1").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label1").style.display = "none"; }, 2000);
                document.getElementById("sifreLabel").innerHTML=password;
                $.ajax({
                    url: 'includes/methodsOfEditProfile.inc.php',
                    type: 'POST',
                    data: {
                        userID: userID,
                        password:password,	
                    },
                });
            } else if (password == "" || password2 == "") {
                setTimeout(function sifre() { document.getElementById("Label3").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label3").style.display = "none"; }, 2000);
            }
            else {
                setTimeout(function sifre() { document.getElementById("Label2").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label2").style.display = "none"; }, 2000);
            }
            document.getElementById('password').value = '';
            document.getElementById('password2').value = '';
        }
    }
</script>
<!-- Bitiş Şifre Değiştirme -->

<!-- Ad Değiştirme -->
<div style='display: -webkit-inline-box;margin-top:20px;width:300px;' id='ad'>
    <label class='p' style='color:black;'>Adı : </label>
    <label style='margin-left:5px;color:black;' ID='adLabel' class='h6' ><?php echo $userInfoRows['name']; ?></label>
    <h6><button onclick='ad(1);return false;' class='fa-border text-center btn-outline-primary' style='margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
Güncelle</button></h6>
</div>
<div id='ad2'  style='width: 300px;display:none;margin-top:20px;'>
    <input type='text' ID='adi' placeholder='Adınızı girin!' class='form-control' ></input>
    <h6><button onclick='ad(3);return false;' class='fa-border text-center btn-outline-success' style='margin-top: 10px;margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
Onayla</button></h6>
    <h6><button onclick='ad(2);return false;' class='fa-border text-center btn-outline-danger' style='margin-top: 10px;margin-left:15px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
İptal</button></h6>
</div>
<div class='text-center' >
    <strong>
        <label ID='Label4' class='alert alert-danger' style='display:none;'>Ad boş bırakılamaz.</label>
        <label ID='Label5' class='alert alert-success' style='display:none;'>Ad başarıyla değişti.</label>
    </strong>
</div>

<script>
    function ad(a) {

        var ad = document.getElementById("ad");
        var ad2 = document.getElementById("ad2");

        if (a == 1) {
            ad.style.display = "none";
            ad2.style.display = "-webkit-inline-box";
            document.getElementById('adi').value=document.getElementById('adLabel').innerHTML;
        } else if (a == 2) {
            ad.style.display = "-webkit-inline-box";
            ad2.style.display = "none";
        } else if (a == 3) {
            ad.style.display = "-webkit-inline-box";
            ad2.style.display = "none";

            var name = document.getElementById('adi').value;
            var userID=document.getElementById('userIDD').value;
            
            if (name != "") {
                $.ajax({
                    url: 'includes/methodsOfEditProfile.inc.php',
                    type: 'POST',
                    data: {
                        userID:userID,
                        name:name,	
                    },
                });
                document.getElementById('adLabel').innerHTML=name;
                document.getElementById('name').innerHTML=name;
                setTimeout(function sifre() { document.getElementById("Label5").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label5").style.display = "none"; }, 2000);
            } else {
                setTimeout(function sifre() { document.getElementById("Label4").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label4").style.display = "none"; }, 2000);
            }
            document.getElementById('adi').value = '';
        }
    }
</script>
<!-- Bitiş Ad Değiştirme -->

<!-- Soyad Değiştirme -->
<div style='display: -webkit-inline-box;margin-top:20px;width:300px;' id='soyad' >
    <label class='p' style='color:black;'>Soyadı :</label>
    <label style='margin-left:5px;color:black;' ID='soyadLabel' class='h6'><?php echo $userInfoRows['surname']; ?></label>
    <h6><button onclick='soyad(1);return false;' class='fa-border text-center btn-outline-primary' style='margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
Güncelle</button></h6>
</div>
<div id='soyad2'  style='width: 300px;display:none;margin-top:20px;'>
    <input type='text' ID='soyadi' placeholder='Soyadınızı girin!' class='form-control' ></input>
    <h6><button onclick='soyad(3);return false;' class='fa-border text-center btn-outline-success' style='margin-top: 10px;margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
Onayla</button></h6>
    <h6><button onclick='soyad(2);return false;' class='fa-border text-center btn-outline-danger' style='margin-top: 10px;margin-left:15px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
İptal</button></h6>
</div>
<div class='text-center' >
    <strong>
        <label ID='Label6' class='alert alert-danger' style='display:none;'>Soyad boş bırakılamaz.</label>
        <label ID='Label7' class='alert alert-success' style='display:none;'>Soyad başarıyla değişti.</label>
    </strong>
</div>
<script>
    function soyad(a) {
        var soyad = document.getElementById("soyad");
        var soyad2 = document.getElementById("soyad2");

        if (a == 1) {
            soyad.style.display = "none";
            soyad2.style.display = "-webkit-inline-box";
            document.getElementById('soyadi').value=document.getElementById('soyadLabel').innerHTML;
        } else if (a == 2) {
            soyad.style.display = "-webkit-inline-box";
            soyad2.style.display = "none";
        } else if (a == 3) {
            soyad.style.display = "-webkit-inline-box";
            soyad2.style.display = "none";

            var soyadi = document.getElementById('soyadi').value;
            var userID = document.getElementById('userIDD').value;
            
            if (soyadi != "") {
                $.ajax({
                    url: 'includes/methodsOfEditProfile.inc.php',
                    type: 'POST',
                    data: {
                        userID:userID,
                        surname:soyadi,	
                    },
                });
                document.getElementById("soyadLabel").innerHTML = soyadi;

                setTimeout(function sifre() { document.getElementById("Label7").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label7").style.display = "none"; }, 2000);
            } else {
                setTimeout(function sifre() { document.getElementById("Label6").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label6").style.display = "none"; }, 2000);
            }
            document.getElementById('soyadi').value = '';
        }
    }
</script>
<!-- Bitiş Soyad Değiştirme -->

<!-- Telefon Değiştirme -->
<div style='display: -webkit-inline-box;margin-top:20px;width:300px;' id='tel' >
    <label class='p' style='color:black;'>Telefon :</label>
    <label style='margin-left:5px;color:black;' ID='telefonLabel' class='h6' ><?php echo $userInfoRows['phone']; ?></label>
    <h6><button onclick='tel(1);return false;' class='fa-border text-center btn-outline-primary' style='margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
Güncelle</button></h6>
</div>
<div id='tel2'  style='width: 300px;display:none;margin-top:20px;'>
    <input type='text' ID='telefon' placeholder='Telefon numaranızı girin!' class='form-control' ></input>
    <h6><button onclick='tel(3);return false;' class='fa-border text-center btn-outline-success' style='margin-top: 10px;margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
Onayla</button></h6>
    <h6><button onclick='tel(2);return false;' class='fa-border text-center btn-outline-danger' style='margin-top: 10px;margin-left:15px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
İptal</button></h6>
</div>
<div class='text-center' >
    <strong>
        <label ID='Label8' class='alert alert-danger' style='display:none;'>Telefon boş bırakılamaz.</label>
        <label ID='Label9' class='alert alert-success' style='display:none;'>Telefon başarıyla değişti.</label>
    </strong>
</div>
<script>
    function tel(a) {

        var tel = document.getElementById("tel");
        var tel2 = document.getElementById("tel2");

        if (a == 1) {
            tel.style.display = "none";
            tel2.style.display = "-webkit-inline-box";
            document.getElementById('telefon').value=document.getElementById('telefonLabel').innerHTML;
        } else if (a == 2) {
            tel.style.display = "-webkit-inline-box";
            tel2.style.display = "none";
        } else if (a == 3) {
            tel.style.display = "-webkit-inline-box";
            tel2.style.display = "none";

            var telefon = document.getElementById('telefon').value;
            var userID = document.getElementById('userIDD').value;
            
            if (telefon != "") {
                $.ajax({
                    url: 'includes/methodsOfEditProfile.inc.php',
                    type: 'POST',
                    data: {
                        userID:userID,
                        phone:telefon,	
                    },
                });
                telefonLabel.innerHTML = telefon;

                setTimeout(function sifre() { document.getElementById("Label9").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label9").style.display = "none"; }, 2000);
            } else {
                setTimeout(function sifre() { document.getElementById("Label8").style.display = "block"; }, 100);
                setTimeout(function sifre() { document.getElementById("Label8").style.display = "none"; }, 2000);
            }
            document.getElementById('telefon').value = '';
        }
    }
</script>
<!-- Bitiş Telefon Değiştirme -->

<!-- Adres Değiştirme -->
<input type='text' ID='addressID' style='display:none;' ></input>
<?php 
$address=mysqli_query($conn,"select * from address where userID=".$_SESSION["userID"]);
$numberOfAddresses=mysqli_num_rows($address);
if($numberOfAddresses==0){
    echo "<div id='adres' style='width: 300px;display:none'>";
}
else
{
    echo "<div id='adres' style='width: 300px;display:inline-grid'>";
} ?>
    <div style='display:-webkit-inline-box;margin-top:20px'>
        <label class='p' style='color:black;'>Adres :</label>
        <select class='form-control h6' id='selectAddress' style='max-width:250px;padding-bottom: 5px;margin-top: -8px;margin-left:5px;'>";
<?php
while($numberOfAddresses>0){
    $row2=mysqli_fetch_assoc($address);
    echo "<option value='".$row2['addressID']."'>".$row2['address']."</option>";
    --$numberOfAddresses;
}
?>
</select>
    </div>
    <div style='display:-webkit-inline-box'>
        <textarea readonly id='TextArea1' class='form-control h6'  style='padding-bottom:100px;margin-left:50px;'></textarea>
        <h6><button onclick='adres(1);return false;' class='fa-border text-center btn-outline-primary' style='margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
    Güncelle</button></h6>
        <h6><button onclick='adres(4);return false;' class='fa-border text-center btn-outline-danger' style='margin-left:15px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
    Sil</button></h6>
    </div>
    <h6><button onclick='adres(5);return false;' class='fa-border btn-outline-success' style='float:left;margin-left:50px;width: 70%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
    Yeni Adres Ekle</button></h6>
</div>
<!-- Adres 2 -->
<?php 
$numberOfAddresses=mysqli_num_rows($address);
if($numberOfAddresses==0){
    echo "<div id='adres2' style='width: 300px;display:inline-grid'>";
}
else
{
    echo "<div id='adres2' style='width: 300px;display:none'>";
} 
?>

    <div style='width: 300px;display:-webkit-inline-box;'>
        <label class='p' style='color:black;margin-top:20px;'>Adres :</label>
        <textarea id='TextArea2' class='form-control h6' placeholder='Yeni adresinizi girin!'  style='margin-top: 10px;margin-left:5px;padding-bottom:100px;'></textarea>
        <h6><button onclick='adres(3);return false;' class='fa-border text-center btn-outline-success' style='margin-top: 10px;margin-left:10px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
        Onayla</button></h6>
        <h6><button onclick='adres(2);return false;' id='cancelBtn' class='fa-border text-center btn-outline-danger' style='margin-top: 10px;margin-left:15px;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);' >
        İptal</button></h6>
    </div>     
    
    <div style='margin-left:50px;'>
        <input type='text' ID='adresTxt' placeholder='Adres adını girin!' class='form-control' style='width: 300px;' ></input>
    </div>
</div>
<div class='text-center' >
    <strong>
        <label ID='LabelSil'  Text='Adres başarıyla silindi.' class='alert alert-danger' style='display:none;margin-left: 60px;width:350px;'></label>
        <label ID='Label10'  Text='Adres boş bırakılamaz.' class='alert alert-danger' style='margin-left: 60px;display:none;width:350px;'></label>
        <label ID='Label11'  Text='Adres başarıyla değişti.' class='alert alert-success' style='margin-left: 60px;display:none;width:350px;'></label>
    </strong>
</div>

<script>
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
                $('#TextArea1').html(data.fullAddress);
            }
        });
    }
    
    function adres(a) {
        var adres = document.getElementById("adres");
        var adres2 = document.getElementById("adres2");
        var adresTxt = document.getElementById("adresTxt");
        var addressID = $('#selectAddress').val(); 
        if (a == 1) 
        {
            adres.style.display = "none";
            adres2.style.display = "inline-grid";
            var adresArea = document.getElementById('selectAddress');
            document.getElementById("adresTxt").value = adresArea.options[adresArea.selectedIndex].innerHTML;
            document.getElementById("TextArea2").value = document.getElementById("TextArea1").value;
            document.getElementById("addressID").value=addressID;
        } 
        else if (a == 2) {
            adres.style.display = "inline-grid";
            adres2.style.display = "none";
            document.getElementById("addressID").value='';
        } 
        else if (a == 3) {
            var address=document.getElementById("adresTxt").value;
            var fullAddress=document.getElementById("TextArea2").value;
            var userID=document.getElementById('userIDD').value;

            if(document.getElementById("addressID").value!=''){
                $.ajax({
                    url: 'includes/methodsOfEditProfile.inc.php',
                    type: 'POST',
                    data: {
                        updateAddress:1,
                        addressID:addressID,	
                        fullAddress:fullAddress,
                        address:address,
                    },
                    success:function (){
                        $('#selectAddress option').each(function() {
                            if ($(this).val() == addressID ) {
                                $(this).remove();
                                var o = new Option(address, addressID);
                                /// jquerify the DOM object 'o' so we can use the html method
                                $(o).html(address);
                                $("#selectAddress").append(o);
                                adres.style.display = "inline-grid";
                                adres2.style.display = "none";
                                onSelected();
                            }
                        });

                    }
                });
            }
            else{
                $.ajax({
                    url: 'includes/methodsOfEditProfile.inc.php',
                    type: 'POST',
                    dataType:'json',
                    data: {
                        fullAddress:fullAddress,
                        address:address,
                        userID:userID,
                    },
                    success:function (data){
                        var o = new Option(address, data.addressID);
                        /// jquerify the DOM object 'o' so we can use the html method
                        $(o).html(address);
                        $("#selectAddress").append(o);
                        adres.style.display = "inline-grid";
                        adres2.style.display = "none";
                        onSelected();
                    }
                });
            }
            document.getElementById("adresTxt").value='';
            document.getElementById("TextArea2").value='';
            adres.style.display = "inline-grid";
            adres2.style.display = "none";
            document.getElementById("addressID").value='';
        }
        else if (a == 4) {
            $.ajax({
                url: 'includes/methodsOfEditProfile.inc.php',
                type: 'POST',
                data: {
                    addressID:addressID,	
                },
            });
            $('#selectAddress option').each(function() {
                if ($(this).val() == addressID ) {
                    $(this).remove();
                    if(!$("#selectAddress").val()){
                        adres2.style.display = "inline-grid";
                        adres.style.display = "none";
                    }
                    else
                    {
                        onSelected();
                    }
                }
                document.getElementById("addressID").value='';
            });
        }
        else if(a==5){
            adres.style.display = "none";
            adres2.style.display = "inline-grid";
            document.getElementById("addressID").value='';
        }
    }
</script>
<!-- Bitiş Adres Değiştirme -->