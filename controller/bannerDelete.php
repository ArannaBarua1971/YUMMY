<?php
require_once "./env.php";
$id=$_REQUEST['id'];


$query0="SELECT * FROM banners WHERE id='$id'";
$response0=mysqli_query($conn,$query0);
$banner_img=mysqli_fetch_assoc($response0)["banner_img"];



if($response0){

    $query1="DELETE FROM banners WHERE id='$id'";
    $response1=mysqli_query($conn,$query1);
    
    if($response1){
        header("location: ../backend/allbanner.php");
    }
    $filepath="../uploads/$banner_img";
    if(file_exists($filepath)){
        unlink($filepath);
    }
}
else{
    header("location: ../backend/allbanner.php");
}


