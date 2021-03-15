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
  <a class='nav-link' href='index.php'>
    <i class='ni ni-bell-55'></i> İletişim Kutusu
  </a>
</li>
<li class='nav-item'>
  <a class='nav-link active text-red' href='addItem.php'>
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
                    <div id='test' class="card-body px-lg-5 py-lg-5">

                    <!--- Burada --->

                    <select class='form-control h6' id='catType' style='padding-bottom: 5px;'>";
                        <option value='Mekanik'>Mekanik</option>
                        <option value='Aksesuar'>Aksesuar</option>
                    </select>

                    <select class='form-control h6' id='cat' onchange='catChanging();' style='padding-bottom: 5px;'>";
                        <?php
                        $categories=mysqli_query($conn,"select * from categories");
                        $numberOfCat=mysqli_num_rows($categories);
                        while($numberOfCat>0){
                            $categoriesRow=mysqli_fetch_assoc($categories);
                            echo "<option value='".$categoriesRow['catID']."' data-tag='".$categoriesRow['catType']."'>".$categoriesRow['cat']."</option>";
                            --$numberOfCat;
                        }
                        ?>
                        <option value='-1' data-tag='-1'>Yeni Kategori Ekleme</option>
                    </select>

                    <script>
                        $(function(){
                            $('#catType').trigger('change'); //This event will fire the change event. 
                        });
                        
                        $('#catType').on('change', function() {
                            var a=0;
                            var valueForMustBeSelect;
                            var selected = $(this).val();
                            $("#cat option").each(function(item){
                                var element =  $(this) ; 
                                if (element.data("tag") != selected){
                                    element.hide(); 
                                    if($(this).attr('value')==-1){

                                        if(a==0)
                                            valueForMustBeSelect=$(this).attr('value');

                                        a++;
                                        element.show();
                                    }
                                }else{
                                    
                                    if(a==0)
                                        valueForMustBeSelect=$(this).attr('value');

                                    a++;
                                    element.show();
                                }
                            }) ;     
                            $("#cat").val($("#catType option:visible:first").val()); 
                            $("#cat").val(valueForMustBeSelect);
                        });

                    </script>

                    <input type='text' ID='item' style='margin-top:8px;' placeholder='Ürün ismini giriniz!' class='form-control'></input>

                    <input type='number' ID='price' style='margin-top:8px;' placeholder='Ürün fiyatını giriniz!' class='form-control'></input>

                    <textarea type='text' ID='info' style='margin-top:8px;padding-bottom: 150px;' placeholder='Ürün açıklaması giriniz!' class='form-control'></textarea>
                    
                    <input id="picture" type="file" style='margin-top:8px;margin-bottom:30px;' name="sortpic"/>

                    <div class="text-center">
                      <strong>
                          <label ID="Label6" class="alert alert-warning" style="display:none">Ürün kategorisi seçmediniz.</label>
                      </strong>
                    </div>

                    <div class="text-center">
                      <strong>
                          <label ID="Label5" class="alert alert-warning" style="display:none">Ürün bilgisi girmediniz.</label>
                      </strong>
                    </div>

                    <div class="text-center">
                      <strong>
                          <label ID="Label4" class="alert alert-warning" style="display:none">Ürün görseli yüklemediniz.</label>
                      </strong>
                    </div>

                    <div class="text-center">
                        <strong>
                            <label ID="Label3" class="alert alert-warning" style="display:none">Fiyat girmediniz.</label>
                        </strong>
                    </div>

                    <div class="text-center">
                        <strong>
                            <label ID="Label2" class="alert alert-warning" style="display:none">Ürün ismi girmediniz.</label>
                        </strong>
                    </div>

                    <div class="text-center">
                        <strong>
                            <label ID="Label1" class="alert alert-success" style="display:none">Ürün eklendi.</label>
                        </strong>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary my-4" onclick="addItem();">Yükle</button>
                    </div>

                    <script>
                        function addItem() {
                            var form_data = new FormData();  

                            var file_data = $('#picture').prop('files')[0];             
                            var catID=$("#cat").val();
                            var item=$("#item").val();
                            var price=$("#price").val();
                            var info=$("#info").val();
                        
                            form_data.append('file', file_data);
                            form_data.append('catID', catID);
                            form_data.append('item', item);
                            form_data.append('price', price);
                            form_data.append('info', info);
    
                            /*for (var value of form_data.values()) {
                                alert(value);
                            }*/
                            
                            if(catID!="-1"){
                                if(item!=""){
                                    if(price!=""){
                                        if(info!=""){
                                            if(file_data!=null){
                                                document.getElementById('Label1').style.display='block';
                                                setTimeout(function (){document.getElementById('Label1').style.display='none'},3000);
                                                
                                                $.ajax({
                                                    url: 'includes/addItem.inc.php', // point to server-side PHP script 
                                                    dataType: 'text',  // what to expect back from the PHP script, if anything
                                                    method:"POST",
                                                    data:form_data,
                                                    contentType:false,
                                                    processData:false
                                                });
                                            }else{
                                                document.getElementById('Label4').style.display='block';
                                                setTimeout(function (){document.getElementById('Label4').style.display='none'},3000);
                                            }
                                        }else{
                                            document.getElementById('Label5').style.display='block';
                                            setTimeout(function (){document.getElementById('Label5').style.display='none'},3000);
                                        }
                                    }else{
                                        document.getElementById('Label3').style.display='block';
                                        setTimeout(function (){document.getElementById('Label3').style.display='none'},3000);
                                    }
                                }else{
                                    document.getElementById('Label2').style.display='block';
                                    setTimeout(function (){document.getElementById('Label2').style.display='none'},3000);
                                }
                            }else{
                                document.getElementById('Label6').style.display='block';
                                setTimeout(function (){document.getElementById('Label6').style.display='none'},3000);
                            }
                        }
                    </script>
                        <!-- Modal -->
                        <div id="myModal" class="modal2">
                            
                            <!-- Modal content -->
                            <div class="modal-content2 fa-border" style="border-radius: 50px;">
                                <div id='close' class="close">&times;</div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6"  style="padding-top:50px;margin:50px 0px;box-shadow: 0 2px 4px 0 rgba(0,0,0,.6);background-color:#fff;padding-bottom: 40px;">
                                        <div style='display:-webkit-inline-box'>
                                            Eklenecek Kategori Türü : <label class='h3' ID='catTypeText' placeholder='Kategori ismini giriniz!'></label></h4>
                                        </div>
                                        <input type='text' ID='catName' placeholder='Kategori ismini giriniz!' class='form-control'></input>


                                        <button onclick='catAdd();' type='button' class='fa-border text-center btn-outline-success btn-modal'>
                                            Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>   
    function catChanging(){
        if($('#cat').val()==-1){
            document.getElementById("myModal").style.display = "block";
            document.getElementById("catTypeText").innerHTML=$('#catType option:selected').val();
        }else{
            document.getElementById("myModal").style.display = "none";
        }
    }

    function catAdd(){
        var cat=$('#catName').val();
        var catType=document.getElementById("catTypeText").innerHTML;
        
        $.ajax({
            url:"includes/addItem.inc.php",
            type:"post",
            data:{
                cat:cat,
                catType:catType,
                setCat:1,
            },
            success:function(data){
                location.reload();
                setTimeout(function(){document.getElementById("success").style.display='block'},2000);
            }
        });
    }

    $(".close").click(function() {
        document.getElementById("myModal").style.display = "none";
        $('#catType').trigger('change'); //This event will fire the change event. 
    });
</script>
</html>