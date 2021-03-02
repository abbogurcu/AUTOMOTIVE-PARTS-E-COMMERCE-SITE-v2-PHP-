<?php

include_once "db.inc.php";

$items=mysqli_query($conn,"select * from items inner join categories on categories.catID=items.catID");
$itemsQuantity=mysqli_num_rows($items);
while ($itemsQuantity>0){
    $row=mysqli_fetch_assoc($items);
    echo "<div class='col-md-3'>";
    echo "<a href='item.php?itemID=".$row['itemID']."'>";
    echo "<div class='full product_blog btn-outline-primary margin_top_30' style='height:375px;'>";
    echo "<p class='itemCat'>".$row['catType']." Parça</p>";
    echo "<img class='indexItemPic' src='".$row['pic']."' />";
    echo "<h3>".$row['item']." ".$row['cat']."</h3>";
    echo "<h3><span style='color: #72dd78 !important;'>".$row['price']." TL</span></h3>";
    echo "</div>
        </a>    
      </div>";
    --$itemsQuantity;
}
?>
