<?php
include "header.php";
echo "
<ul class='navbar-nav'>
<li class='nav-item active'>
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
  <div class="container">
    <div class="row">
      <div class="col-xl-12 fa-border" style="border-color:rgba(0, 0, 0, 0.4);max-height:250px !important;border-top-width: 0px;border-radius:5px;">
        <img class="img-responsive" style="max-height:100%;" src="images/banner.png" alt="#" />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="margin-top:50px;margin-bottom:50px;">
        <h2>Ürünler</h2>
        <div class="fa-border" style="border-color:black;border-width:0px;border-radius:30px;background-color:lightslategray;padding:5px 20px !important;">
          <div class="row product_section" style="margin-bottom:25px;">
          <!-- Products -->

          <?php include "includes/index.inc.php";?>

          <!-- Products -->
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
include "footer.php";
?>