<?php
include_once 'env.php';
session_start();

$checkInfo=$_REQUEST;
$email=$checkInfo['email'];
$password=$checkInfo['password'];

$query ="SELECT* FROM user_info WHERE email='$email'";
$reponse=mysqli_query($conn,$query);
$data =mysqli_fetch_assoc($reponse);

$email_found=$reponse->num_rows;
$errors=[];

// email validate
if(empty($email)){
    $errors['login_email_error']="Enter your email";
}
else if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
    $errors['login_email_error']="Enter valid email";
}else if(!$email_found){
    $errors['login_email_error']="Your email is not exist";
}

// password validate
if(empty($password)){
    $errors['login_password_error']="Enter your password";
}
else if(strlen($password)<8){
    $errors['login_password_error']="Enter valid password";
}

if(count($errors)){
    $_SESSION['checkInfo']=$checkInfo;
    $_SESSION['login_error']=$errors;
    header('Location: ../login.php');
}
if($email_found){
    $verifyPassword=password_verify($password,$data['password']);
    echo $verifyPassword;

    if($verifyPassword){
        $_SESSION['data']=$data;
        header('location:../backend/daseboard.php');
    }
    else{
        $errors['login_password_error']="You entered Wrong password";
        $_SESSION['checkInfo']=$checkInfo;
        $_SESSION['login_error']=$errors;
        header('location: ../login.php');
    }
}