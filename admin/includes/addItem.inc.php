<?php
include $_SERVER['DOCUMENT_ROOT']."/e-commerce-site/includes/db.inc.php";

/*if(isset($_POST["checkCat"])){
    $result=mysqli_query($conn,"select * from categories where cat='".$_POST['cat']."' and catType='".$_POST['catType']."'");
    $cust = mysqli_fetch_assoc($result);
    if($cust) {
        echo json_encode($cust);
    }
}*/

if(isset($_POST["setCat"])){
    $result=mysqli_query($conn,"select * from categories where cat='".$_POST['cat']."' and catType='".$_POST['catType']."'");
    if(mysqli_num_rows($result)==0)
        mysqli_query($conn,"insert into categories(cat,catType) values('".$_POST['cat']."','".$_POST['catType']."')");
}

if(0 < $_FILES['file']){   
    $getItem=mysqli_query($conn,"select * from items where item='".$_POST['item']."' and price='".$_POST['price']."' and catID='".$_POST['catID']."' and info='".$_POST['info']."'");
    $checkItem=mysqli_num_rows($getItem);

    if($checkItem==0){
        mysqli_query($conn,"insert into items(item,price,catID,info) values('".$_POST['item']."','".$_POST['price']."','".$_POST['catID']."','".$_POST['info']."')");
        
        $getItemID=mysqli_query($conn,"select * from items where item='".$_POST['item']."' and price='".$_POST['price']."' and catID='".$_POST['catID']."' and info='".$_POST['info']."'");
        $getItemIDRow=mysqli_fetch_assoc($getItemID);
        
        $getCategory=mysqli_query($conn,"select * from categories where catID='".$_POST['catID']."'");
        $catTypeRow=mysqli_fetch_assoc($getCategory);

        $pictureURL=$_SERVER['DOCUMENT_ROOT']."/e-commerce-site/pictures/";
        $catURL=$_SERVER['DOCUMENT_ROOT']."/e-commerce-site/pictures/";

        if (!is_dir($pictureURL)) {
            mkdir($pictureURL);
        }

        $updatePicUrl="pictures/";

        if($catTypeRow['catType']=='Mekanik'){
            $catURL.="mechanic/".$catTypeRow['cat']."/";
            $pictureURL.="mechanic/".$catTypeRow['cat']."/".$getItemIDRow['itemID']."/";
            $updatePicUrl.="mechanic/".$catTypeRow['cat']."/".$getItemIDRow['itemID']."/";
        }else{
            $catURL.="body parts/".$catTypeRow['cat']."/";
            $pictureURL.='body parts/'.$catTypeRow['cat']."/".$getItemIDRow['itemID']."/";
            $updatePicUrl.='body parts/'.$catTypeRow['cat']."/".$getItemIDRow['itemID']."/";
        }

        if (!is_dir($catURL)) {
            mkdir($catURL);
        }

        if (!is_dir($pictureURL)) {
            mkdir($pictureURL);
        }

        mysqli_query($conn,"update items set pic='".($updatePicUrl.$_FILES['file']['name'])."' where itemID='".$getItemIDRow['itemID']."'");
        move_uploaded_file($_FILES['file']['tmp_name'],$pictureURL.$_FILES['file']['name']);
    }
}

?>