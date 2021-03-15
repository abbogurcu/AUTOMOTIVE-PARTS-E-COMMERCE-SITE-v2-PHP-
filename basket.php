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
  <a class='nav-link' href='access.php'>Aksesuar</a>
</li>
<li class='nav-item'>
  <a class='nav-link' href='contact.php'>İletişim</a>
</li>
</ul>
";
include "header2.php";

?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<div style="background-color: #ebebeb;">
    <div class="container">
        <div class="row justify-content-between">
            <div class='col-md-8 sepetDolu'>
                <h1 style='margin: 20px 0px;'>Sepetim </h1>
                
                <?php include "includes/insideOfBasket.php"?>

            </div>
        </div>
    </div>
    <!-- The Modal -->

    <div id="myModal" class="modal2">        
        <!-- Modal content -->
        <div class="modal-content2 fa-border" style="border-radius: 50px;">
            <div id="kapat" class="close">&times;</div>
            <h2>MESAFELİ SATIŞ SÖZLEŞMESİ</h2>
            <h4>1.TARAFLAR</h4>
            <p>İşbu Sözleşme aşağıdaki taraflar arasında aşağıda belirtilen hüküm ve şartlar çerçevesinde imzalanmıştır. </p>
            <h5>A.‘ALICI’ ; (sözleşmede bundan sonra "ALICI" olarak anılacaktır)</h5>

            <h5>B.‘SATICI’ ; (sözleşmede bundan sonra "SATICI" olarak anılacaktır)</h5>
            <p>AD- SOYAD:</p>
            <p>ADRES: </p>
            <p>İş bu sözleşmeyi kabul etmekle ALICI, sözleşme konusu siparişi onayladığı takdirde sipariş konusu bedeli ve varsa kargo ücreti, vergi gibi belirtilen ek ücretleri ödeme yükümlülüğü altına gireceğini ve bu konuda bilgilendirildiğini peşinen kabul eder.</p>
            <h4>2.TANIMLAR</h4>
            <p>İşbu sözleşmenin uygulanmasında ve yorumlanmasında aşağıda yazılı terimler karşılarındaki yazılı açıklamaları ifade edeceklerdir.</p>
            <p>BAKAN: Gümrük ve Ticaret Bakanı’nı,</p>
            <p>BAKANLIK: Gümrük ve Ticaret  Bakanlığı’nı,</p>
            <p>KANUN: 6502 sayılı Tüketicinin Korunması Hakkında Kanun’u,</p>
            <p>YÖNETMELİK: Mesafeli Sözleşmeler Yönetmeliği’ni (RG:27.11.2014/29188)</p>
            <p>HİZMET: Bir ücret veya menfaat karşılığında yapılan ya da yapılması taahhüt edilen mal sağlama dışındaki her türlü tüketici işleminin konusunu ,</p>
            <p>SATICI: Ticari veya mesleki faaliyetleri kapsamında tüketiciye mal sunan veya mal sunan adına veya hesabına hareket eden şirketi,</p>
            <p>ALICI: Bir mal veya hizmeti ticari veya mesleki olmayan amaçlarla edinen, kullanan veya yararlanan gerçek ya da tüzel kişiyi,</p>
            <p>SİTE: SATICI’ya ait internet sitesini,</p>
            <p>SİPARİŞ VEREN: Bir mal veya hizmeti SATICI’ya ait internet sitesi üzerinden talep eden gerçek ya da tüzel kişiyi,</p>
            <p>TARAFLAR: SATICI ve ALICI’yı,</p>
            <p>SÖZLEŞME: SATICI ve ALICI arasında akdedilen işbu sözleşmeyi,</p>
            <p>MAL: Alışverişe konu olan taşınır eşyayı ve elektronik ortamda kullanılmak üzere hazırlanan yazılım, ses, görüntü ve benzeri gayri maddi malları ifade eder.</p>
            <h4>3.KONU</h4>
            <p>İşbu Sözleşme, ALICI’nın, SATICI’ya ait internet sitesi üzerinden elektronik ortamda siparişini verdiği aşağıda nitelikleri ve satış fiyatı belirtilen ürünün satışı ve teslimi ile ilgili olarak 6502 sayılı Tüketicinin Korunması Hakkında Kanun ve Mesafeli Sözleşmelere Dair Yönetmelik hükümleri gereğince tarafların hak ve yükümlülüklerini düzenler.
            Listelenen ve sitede ilan edilen fiyatlar satış fiyatıdır. İlan edilen fiyatlar ve vaatler güncelleme yapılana ve değiştirilene kadar geçerlidir. Süreli olarak ilan edilen fiyatlar ise belirtilen süre sonuna kadar geçerlidir.</p>
        </div>
    </div>
      <!-- main content -->

    <script type="text/javascript">
            function showSozlesme() {
                document.getElementById("myModal").style.display = "block";
            }

            var span = document.getElementsByClassName("close")[0];

            span.onclick = function () {
                document.getElementById("myModal").style.display = "none";
            }
    </script>
<?php
include "footer.php";
?>
