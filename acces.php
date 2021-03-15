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
<li class='nav-item active'>
  <a class='nav-link' href='acces.php'>Aksesuar</a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='contact.php'>İletişim</a>
</li>
</ul>
";
include "header2.php";
?>
<div style="background-color:#ebebeb;">
    <div class="container-fluid" style="margin:0% 5%">
        <div class="row">
            <div class="col-xl-12 fa-border" style="border-color:rgba(0, 0, 0, 0.4);max-height:250px !important;border-top-width: 0px;border-radius:5px;">
                <img class="img-responsive" style="max-height:100%;" src="images/banner.png" alt="#" />
            </div>
        </div>
        <div class="row justify-content-between" id="items">

            <div class="col-md-2" style="height:fit-content;margin:50px 0px;padding:15px;box-shadow: 0 2px 4px 0 rgba(0,0,0,.6);background-color:#fff;">
                <h2>Kategoriler</h2>
                <?php
                include "includes/db.inc.php";
                $getCategories=mysqli_query($conn,"select * from items inner join categories on categories.catID=items.catID where catType='Aksesuar'");
                $getCategoriesNum=mysqli_num_rows($getCategories);
                while ($getCategoriesNum>0){
                    $getCategoriesRow=mysqli_fetch_assoc($getCategories);
                        echo "<label class='p' style='color:black;'><input id='CheckBox1' checked='checked' name='CheckBox1' class='checkmark' type='checkbox'  value='".$getCategoriesRow['cat']."'>
                            <label class='h6' style='font-weight:400;margin-left:30px;' >".$getCategoriesRow['cat']."</label></label>
                        <br />";
                    --$getCategoriesNum;
                }
                ?>
            </div>
            <div class="col-md-9" style="margin:50px 0px;padding:25px;box-shadow: 0 2px 4px 0 rgba(0,0,0,.6);background-color:#fff;">
                <div class="fa-border" style="border-color:black;border-width:0px;border-radius:30px;background-color:#c7c7c7;padding:5px 20px !important;">
                    <div class="row product_section" style="margin-bottom:25px;">                  
                        <div id="kategorilerBos" style="display:none;margin-top: 28px;">
                            <h4>Ürünleri görmek için kategori seçiniz.</h4> 
                        </div>
                        <!-- Products -->
                            <?php include "includes/acces.inc.php";?>
                        <!-- Products -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var $items = $("#items");
    $inputs = $items.find("input");
    $inputs.attr("checked", "checked");
    $inputs.on("change", function () {
        $inputs.each(function (i, cb) {
            if (!cb.checked) {
                $items.find("." + this.value).css("display", "none");

                checkboxes = document.getElementsByClassName('checkmark');
                var a = false;
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    if (checkboxes[i].checked) {
                        a = true;
                    }
                }
                if (a == false) {
                    document.getElementById("kategorilerBos").style.display = "block";
                } else {
                    document.getElementById("kategorilerBos").style.display = "none";
                }
            }
        });
        $inputs.each(function (i, cb) {
            if (cb.checked) {
                $items.find("." + this.value).css("display", "block");
                document.getElementById("kategorilerBos").style.display = "none";
            }
        });
    });
</script>
<?php
include "footer.php";
?>