<?php
session_start();
include_once './env.php';
$menuName=$_REQUEST['menu'];

if(empty($menuName)){
    $_SESSION['menu_error']="Enter the menu";
    header("location: ../backend/menu.php");
}else{
    $query="INSERT INTO menus(menu_name) VALUES ('$menuName')";
    $response=mysqli_query($conn,$query);
    
    if($response){
        header("location: ../backend/menu.php");
    }
}