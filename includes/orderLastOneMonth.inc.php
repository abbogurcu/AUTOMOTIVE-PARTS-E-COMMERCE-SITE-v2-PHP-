<?php
include "db.inc.php";

$fullOrder = mysqli_query($conn,"select DISTINCT * from `e-commerce`.order where userID='".$_SESSION['userID']."' and STR_TO_DATE(dateOfOrder,'%d.%m.%Y')>date_add(date(now()),interval -1 month) group by orderNo order by dateOfOrder desc");
$numberOfOrders = mysqli_num_rows($fullOrder);
while($numberOfOrders>0){
    $orderRow=mysqli_fetch_assoc($fullOrder);
    echo "
    <div class='fa-border' style='padding-left: 10px;padding-right: 10px;padding-top:10px;padding-bottom:45px;border-radius:20px;border-color:rgba(0,0,0,0.4);margin-bottom: 50px;'>
    <label  id='Label13' class='h6' style='color:black;margin:0px 5px;'>Sipariş No : ".$orderRow['orderNo']."</label>
        <label  id='Label12' class='h6' style='float:right;color:black;margin:0px 5px;'>Sipariş Tarihi : ".$orderRow['dateOfOrder']."</label>
    <table border='1' id='tableSiparis' style='border-collapse:unset;border-color:rgba(0,0,0,0.6);width:100%'>
        <tbody>
            <tr class='alert alert-info h6 text-center'>
                <th style='font-size:14px;' scope='col'>Ürün Adı</th>
                <th style='font-size:14px;' scope='col'>Adet</th>
                <th style='font-size:14px;' scope='col'>Adres</th>
                <th style='font-size:14px;' scope='col'>Kargo Firması</th>
                <th style='font-size:14px;' scope='col'>Kargo No</th>
                <th style='font-size:14px;' scope='col'>Birim Fiyatı</th>
                <th style='font-size:13px;' scope='col'>Fiyat</th>
                <th style='font-size:14px;' scope='col'></th>
            </tr>";
            $orderDetail = mysqli_query($conn,"select * from `e-commerce`.order inner join items on order.itemID=items.itemID inner join categories on categories.catID=items.catID where userID='".$_SESSION['userID']."' and orderNo='".$orderRow['orderNo']."'");
            $numberOfDetailedOrders = mysqli_num_rows($orderDetail);
            $totalPrice=0;
            while($numberOfDetailedOrders>0){
                $orderDetailRow=mysqli_fetch_assoc($orderDetail);
                $itemTotalPrice=$orderDetailRow['quantity']*$orderDetailRow['price'];
                echo "
                <td style='width:172px;'>  
                    <div class='text-center h6'>
                        <label  id='Text1' style='color:black;margin:0px 5px;'>".$orderDetailRow['item']." ".$orderDetailRow['cat']."<label>
                    </div>
                </td>
                <td style='width:30px;'>  
                    <div class='text-center h6'>
                        <label  id='Label14' style='color:black;margin:0px 5px;'>".$orderDetailRow['quantity']."<label>
                    </div>
                </td>
                <td style='width:30px;'>  
                    <div class='text-center h6'>
                        <label  id='Label15' style='font-size: 12px;color:black;margin:0px 5px;'>".$orderDetailRow['fullAddress']."<label>
                    </div>
                </td>
                <td style='width:111px;'>  
                    <div class='text-center h6'>
                        <label  id='Label16' style='color:black;margin:0px 5px;'>".$orderDetailRow['cargo']."<label>
                    </div>
                </td>
                <td style='width:101px;'>  
                    <div class='text-center h6'>
                        <label  id='Label17' style='color:black;margin:0px 5px;'>".$orderDetailRow['cargoNo']."<label>
                    </div>
                </td>
                <td style='width:90px;'>  
                    <div class='text-center h6'>
                        <label  id='Label18' style='font-size: 15px;color:black;margin:0px 5px;'>".$orderDetailRow['price']." TL<label>
                    </div>
                </td>
                <td style='width:117px;'>  
                    <div class='text-center h6'>
                        <label  id='totalFiyat' style='color:black;margin:0px 5px;'>".$itemTotalPrice." TL<label>
                    </div>
                </td>
                <td style='width:50px;'>  
                    <div class='text-center h6'>
                        <h4><a href='item.php?itemID=".$orderDetailRow['itemID']."' class='fa-border text-center btn-outline-primary' style='padding:0px 5px;margin-top:5px;width: 100%;border-radius: 20px;display:inline-block;border-color:rgba(0,0,0,0.5);' >
                            Detay</a></h4>
                    </div>
                </td>
            </tr>";
                    --$numberOfDetailedOrders;
                    $totalPrice+=$itemTotalPrice;
            }
            $KDVPrice=($totalPrice*0.18);
            $withoutKDVPrice=$totalPrice-$KDVPrice;
        echo "
        </tbody>
    </table>
    <br />
    <label  id='Label21' class='h6 alert alert-success' style='float:right;color:black;margin:0px 5px;'>Toplam Fiyat(KDV Hariç) : ".$withoutKDVPrice." TL</label><br /><br />
    <label  id='Label20' class='h6 alert alert-danger' style='float:right;color:black;margin:0px 5px;'>Toplam KDV : ".$KDVPrice." TL</label><br /><br />
    <label  id='Label19' class='h6 alert alert-info' style='float:right;color:black;margin:0px 5px;'>Toplam Fiyat : ".$totalPrice." TL</label><br />
    </div>
    ";
    --$numberOfOrders;
}
?>