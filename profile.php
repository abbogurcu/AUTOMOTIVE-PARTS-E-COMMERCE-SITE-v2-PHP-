<?php
include "includes/db.inc.php";
if(!isset($_SESSION)){session_start();}
if(!is_numeric($_SESSION['userID']))
    header("location:login.php");

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


$nameSurnameInfo=mysqli_query($conn,"select * from users where userID='".$_SESSION["userID"]."' and auth=0");
$nameSurnameInfoRows=mysqli_fetch_assoc($nameSurnameInfo);

?>
<div class="container" style="padding-left:15px !important;padding-right:15px !important;">
        <div class="row justify-content-center">
            <div class="col-md-3 fa-border" style="max-height: 330px;border-color:rgba(0,0,0,0.5);margin-top:100px;margin-bottom:100px;border-radius:10px;">
                <h4 class="fa-border form-control-label" style="display: inline-block;width: 100%;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);margin-top:10px;">
                    <div class='display:-webkit-inline-box;'> 
                        <img style="width:64px;height:auto" src="images/profile.png" alt="#" />
                        <label style="font-size: 16px;" ID="name"><?php echo $nameSurnameInfoRows['name']." "?></label>
                        <label style="font-size: 16px;" ID="surname"><?php echo $nameSurnameInfoRows['surname'] ?></label>
                    </div>
                    <label  ID="userID" style="display:none"></label>
                </h4>
                <div id="div4">
                    <h4><button OnClick="profil(1);return false;disable(this);" class="fa-border text-center btn-outline-warning h5" style="padding: 10px;outline:none;width: 100%;border-radius: 20px;margin-top:100px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);" >
                        Profil Bilgilerim</button></h4>

                    <h4><button OnClick="profil(2);return false;disable(this);" class="fa-border text-center btn-outline-warning h5" style="padding: 10px;outline:none;width: 100%;border-radius: 20px;display:inline-block;border-width:unset;border-bottom-width:1px;border-color:rgba(0,0,0,0.5);" >
                        Siparişlerim</button></h4>
                </div>
<script>
    function profil(a){
        if(a==1){
            document.getElementById('profile').style.display='block';
            document.getElementById('order').style.display='none';
        }else{
            document.getElementById('profile').style.display='none';
            document.getElementById('order').style.display='block';
        }
    }
</script>
            </div>
            <div class="col-md-9" style="padding-left:35px;border-color:black;border-width:0px;border-left-width:1px;">
                <div id="profile" style="padding-bottom:50px;margin-top:100px;">
                    <?php include "includes/editProfile.inc.php";?>
                </div>
                <div id="order" style="display:none;padding-top:1px;padding-bottom:50px;" >
                    <?php include "includes/orderProfile.inc.php";?>  
                </div>
            </div>
        </div>
    </div>