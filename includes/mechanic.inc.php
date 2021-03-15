<?php

include_once "db.inc.php";

$items=mysqli_query($conn,"select * from items inner join categories on categories.catID=items.catID where catType='Mekanik'");
$itemsQuantity=mysqli_num_rows($items);
while ($itemsQuantity>0){
    $row=mysqli_fetch_assoc($items);
    echo "
    <div class='col-lg-3 ".$row['cat']."'> 
    <a href='item.php?itemID=".$row['itemID']."'>
        <div class='full product_blog btn-outline-primary margin_top_30' style='height:375px;border-radius:20px;'>
            <p style='margin-bottom: -3px;font-weight:500;font-size:13px;color:indianred !important;'>".$row['catType']." Parça</p>
            <img style='width:auto;max-width:100%;max-height:200px;margin-right:auto;margin-left:auto;display:block;' src='".$row['pic']."' alt='#' />
            <h3>".$row['item']." ".$row['cat']."</h3>
            <h2 style='bottom: 5%;position: absolute;text-align: center;left: 10%;right: 10%;'>
                <span style='color: #27ff00 !important;font-weight:500;'>".$row['price']." TL</span>
            </h2>
        </div>
    </a>
</div>";
    --$itemsQuantity;
}
?>
