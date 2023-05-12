<?php
include_once "./env.php";
session_start();
$foodDetails=$_REQUEST;

$title=$foodDetails['title'];
$description=$foodDetails['description'];
$price=$foodDetails['price'];
$catagory=$foodDetails['catagory'];
$foodImg=$_FILES['foodImg'];
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


// IMAGE VALIDATE
$imgExe=['png','jpeg','jpg','wbep'];
$foodImgExe=strtolower(pathinfo($foodImg['name'],PATHINFO_EXTENSION));

if(!$foodImg['size']){
    $error['file_error']="please enter the picture";
}
else if(!in_array($foodImgExe,$imgExe)){
    $error['file_error']="This type extension file is not supported";
}

// PRICE VALIDATE
if(empty($price)){
    $error['price_error']="Enter the price";
}

if(empty($catagory)){
    $error['catagory_error']="Enter the catagory";
}

if(count($error)){
    $_SESSION['old_food_details']=$foodDetails;
    $_SESSION['food_errors']=$error;
    header("Location: ../backend/food.php");
}
else{
    $newImgName="food-".uniqid().".".$foodImgExe;
    var_dump($foodImg);
    $uploadedFile=move_uploaded_file($foodImg['tmp_name'],"../uploads/$newImgName");
    if($uploadedFile){
        $query="INSERT INTO foods(food_name, description, price, food_img, menu_id) VALUES ('$title','$description','$price','$newImgName','$catagory')";
        $response=mysqli_query($conn,$query);

        if($response){
            header("Location: ../backend/food.php");
        }
    }
}