<?php
session_start();
$bannerDetails=$_REQUEST;
$bannerFiles=$_FILES['bannerImg'];

$title=$bannerDetails['title'];
$description=$bannerDetails['description'];
$callToActionButton=$bannerDetails['callToAction'];
$callToActionButtonUrl=$bannerDetails['callToActionUrl'];
$vedioLink=$bannerDetails['videoLink'];
$error=[];

$imgExe=['png','jpeg','jpg','wbep'];
$bannerImgExe=strtolower(pathinfo($bannerFiles['name'],PATHINFO_EXTENSION));

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
if(!($bannerFiles['size'])){
    $error['file_error']="upload the Banner image";
}
else if(!in_array($bannerImgExe,$imgExe)){
    $error['file_error']="This type of extension Banner image is not supported";
}


if(count($error)){
    $_SESSION['old_banner_details']=$bannerDetails;
    $_SESSION['old_banner_img']=$bannerFiles['name'];
    $_SESSION['Banner_errors']=$error;
    header('location: ../backend/banner.php');
}
else{
    require_once "./env.php";

    $bannerimg="banner".uniqid().".".$bannerImgExe;
    if(!file_exists("../uploads")){
        mkdir("../uploads");
    }

    $uploadedFile=move_uploaded_file($bannerFiles["tmp_name"],"../uploads/$bannerimg");

    if($uploadedFile){

        $query ="INSERT INTO banners (title, description, call_to_action_text, call_to_action_link, video_link, banner_img) VALUES ('$title','$description','$callToActionButton','$callToActionButtonUrl','$vedioLink','$bannerimg')";

        $response=mysqli_query($conn,$query);
        if($response){
            header("location: ../backend/banner.php");
        }
    }

}

