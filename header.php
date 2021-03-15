<?php 
  if(!isset($_SESSION)){session_start();}
  if(!isset($_SESSION["userID"])){
    $_SESSION["userID"]=session_id();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Site Metas -->
    <title>ERU CAR MECHANIC AND ACCESSORIES</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- FontAwesome Icons core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom animate styles for this template -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <!-- Responsive styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">
    <!-- Colors for this template -->
    <link href="css/colors.css" rel="stylesheet">
    <!-- light box gallery -->
    <link href="css/ekko-lightbox.css" rel="stylesheet">
    <!-- MY CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/ekko-lightbox.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  </head>
  <body id="home_page" class="home_page">     
    <!-- header -->
    <header class="header">
      <div class="header_top_section">
          <div class="container" style="width:auto !important;margin-left:25px !important;margin-right:25px !important;">
            <div class="row">
              <div class="col-lg-3">
                <div class="full">
                    <div class="logo" style="margin-left: 15px;">
                      <a href="index.php"><img src="images/logov2.png" alt="#" /></a>
                    </div>
                </div>
              </div>
              <div class="col-lg-4 site_information">
                <div class="full">
                    <div class="top_section_info">
                        <ul>
                          <li>İletişim : <img src="images/i1.png" alt="#" /> <a href="#">( +90 352 207 66 66 )</a></li>
                          <li><img src="images/i2.png" alt="#" /> <a href="#">basinyayin@erciyes.edu.tr</a></li>
                          <li style="margin-top:10px;"><img src="images/i3.png" alt="#" /> <a href="#">Yenidoğan, Turhan Baytop Sokak No:1, 38280 Talas/Kayseri</a></li>
                      </ul>
                    </div>
                </div>
              </div>
              <div class="col-lg-3" style="padding-top:30px;">
                <a class="h5 fa-border btn-outline-success pull-right" style="width: 160px;margin-left: 5px;padding-right:10px;color:white;border-radius:10px;border-width:1px;" href="basket.php"><img style="width:52px;height:auto" src="images/basketv2.png" alt="#" />Sepet</a> 
              
                <!--- Sepet Ürün Sayısı --->
                <label id=basketQuantity Class="fa-border h5 fa-border btn-success pull-right" style="display:none;border-color:black;color: white;border-radius: 30px;padding: 3px 10px;position: absolute;right: 20px; top: 49px;font-weight: 300;"></label>
                
                <?php echo "<input type='text' id='basketUserID' style='display:none;' value='".$_SESSION['userID']."'/>";?> 

                <script>
                  $(document).ready(function() {
                    function checkBasket(){
                      var userID=document.getElementById('basketUserID').value;
                      $.ajax({
                        url:"includes/basket.inc.php",
                        type:"post",
                        dataType:"json",
                        data:{
                          userID:userID,
                          basketQuantity:1,
                        },
                        success:function(data){
                          if(data.quantities>0){   
                            document.getElementById('basketQuantity').style.display='block';                 
                            document.getElementById('basketQuantity').innerHTML=data.quantities;
                          }else{
                            document.getElementById('basketQuantity').style.display='none';
                          }
                        }
                      });
                    }

                    checkBasket();
                  });
                </script>
                <!--- Sepet Ürün Sayısı --->


                <a class="h5 fa-border btn-outline-warning pull-right" style="padding-right:10px;color:white;border-radius:10px;border-width:1px;" href="profile.php"><img style="width:52px;height:auto" src="images/profile.png" alt="#" />Hesabım</a>                      
              </div>
              <div class="col-lg-2">
                  <div class="pull-right">
                    <form method="post" action="includes/header.inc.php">
                      <!--- Acc Giriş --->
                      <?php 
                        if(isset($_SESSION["userID"])&&is_numeric($_SESSION["userID"])){
                          echo "<label class='h6' style='color:white;margin-right:7px;'>".$_SESSION["namesurname"]."</label>";
                          echo "<button name='logoutBtn' type='submit' class='btn-outline-danger fa-border exitAcc'>çıkış yap.</button>";
                        }
                        else{
                          echo "<a class='loginAcc' href='login.php'>Giriş Yap</a>";
                        }
                      ?>
                      <!--- Acc Çıkış --->
                    </form>
                  </div>
              </div>
            </div>
        </div>
      </div>

      <div class="header_bottom_section" style="border-color:black;">
        <div class="container"> 
          <div class="row">
            <div class="col-md-12">
              <div class="full ">
                <div class="main_menu">
                  <nav class="navbar navbar-inverse navbar-toggleable-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#cloapediamenu" aria-controls="cloapediamenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="float-left">Menu</span>
                    <span class="float-right"><i class="fa fa-bars"></i> <i class="fa fa-close"></i></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center" id="cloapediamenu">