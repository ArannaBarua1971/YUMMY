<?php

require_once "./env.php";
$id=$_REQUEST['id'];

$query0="SELECT status FROM banners WHERE id='$id'";
$response0=mysqli_query($conn,$query0);
$bannerStatus=mysqli_fetch_assoc($response0)['status'];


if(!$bannerStatus){
    
    $query2="SELECT id FROM banners WHERE status=1";
    $response2=mysqli_query($conn,$query2);
    $deactivate=mysqli_fetch_all($response2,1);
    
    foreach($deactivate as $deac){
        $newId=$deac['id'];
        $query3="UPDATE banners SET status=0 WHERE id='$newId'";
        $response3=mysqli_query($conn,$query3);
    }

    $query1="UPDATE banners SET status=1 WHERE id='$id'";
    $response1=mysqli_query($conn,$query1);
}else{
    $query1="UPDATE banners SET status=0 WHERE id='$id'";
    $response1=mysqli_query($conn,$query1);
}

header('location: ../backend/allbanner.php');