<?php
include_once "./env.php";
session_start();
$bannerDetails=$_REQUEST;

$title=$bannerDetails['title'];
$description=$bannerDetails['description'];
$callToActionButton=$bannerDetails['callToAction'];
$callToActionButtonUrl=$bannerDetails['callToActionUrl'];
$vedioLink=$bannerDetails['videoLink'];
$bannerimg=$_FILES['bannerImg'];
$bannerId=$bannerDetails['id'];

$error=[];


// title validate
if(empty($title)){
    $error['title_error']="Enter the title";
}
else if(strlen($title)>40){
    $error['title_error']="The length of title is always below 41 character";
}

// description validate
if(empty($description)){
    $error['description_error']="Enter the description";
}
else if(strlen($description)>231){
    $error['description_error']="The length of description is always below 230 character";
}

// callto Action Button validate
if(empty($callToActionButton)){
    $error['callToAction_error']="Enter the Call to Action button";
}


// IMAGE VALIDATE
$imgExe=['png','jpeg','jpg','wbep'];
$bannerImgExe=strtolower(pathinfo($bannerimg['name'],PATHINFO_EXTENSION));

if(!in_array($bannerImgExe,$imgExe) && $bannerimg['size']!=0){
    $error['file_error']="This type of extension Banner image is not supported";
}

if(count($error)){
    $_SESSION['Banner_errors']=$error;
    // var_dump($error);
    header('location: ../backend/bannerEditor.php');
}else if($bannerimg['size']!=0){

    $query1="SELECT banner_img FROM banners WHERE id='$bannerId'";
    $response=mysqli_query($conn,$query1);
    $old_banner=mysqli_fetch_assoc($response)['banner_img'];

    $old_file="../uploads/".$old_banner;

    if(file_exists($old_file)){
        unlink($old_file);
    }

    $newBanner="banner".uniqid().".".$bannerImgExe;
    move_uploaded_file($bannerimg['tmp_name'],"../uploads/$newBanner");

    $query2="UPDATE banners SET title='$title',description='$description',call_to_action_text='$callToActionButton',call_to_action_link='$callToActionButtonUrl',video_link='$vedioLink',banner_img='$newBanner' WHERE id='$bannerId'";
    $response=mysqli_query($conn,$query2);

    header('location: ../backend/allbanner.php');
}
    $query3="UPDATE banners SET title='$title',description='$description',call_to_action_text='$callToActionButton',call_to_action_link='$callToActionButtonUrl',video_link='$vedioLink'  WHERE id='$bannerId'";
    $response=mysqli_query($conn,$query3);

    header('location: ../backend/allbanner.php');

