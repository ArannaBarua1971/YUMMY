<?php

include_once 'env.php';
// redirect error
session_start();

$info=$_REQUEST;

$name=$info['name'];
$email=$info['email'];
$phone=$info['phone'];
$password=$info['password'];
$confirm_password=$info['confirm_password'];

$errors=[];


// name validate 
if(empty($name)){
    $errors['name_error']="Enter your name";
}

// email validate
if(empty($email)){
    $errors['email_error']="Enter your email";
}
else if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
    $errors['email_error']="Enter valid email";
}
else{
    $query ="SELECT* FROM user_info WHERE email='$email'";
    $reponse=mysqli_query($conn,$query);

    $email_found=$reponse->num_rows;

    if($email_found){
        $errors['email_error']="this email already exist";
    }
}

// phone number validate
if(empty($phone)){
    $errors['phone_error']="Enter your phone number";
}
else if(strlen($phone)!=11){
    $errors['phone_error']="Enter valid phone number";
}

// password validate
if(empty($password)){
    $errors['password_error']="Enter your password";
}
else if(strlen($password)<8){
    $errors['password_error']="Enter valid password";
}

// confirm_password validate
if(empty($confirm_password)){
    $errors['confirm_password_error']="Enter your confirm password";
}
else if($confirm_password!==$password){
    $errors['confirm_password_error']="Not match password";
}

// error message sent or not sent decision
if(count($errors)){
    // if errors found
    // redirect the error message
    $_SESSION['ERROR']=$errors;
    $_SESSION['INFO']=$info;
    header('Location: ../register.php');
}
else{
    // if no errors found
    $password=password_hash($password,PASSWORD_BCRYPT);
    $query="INSERT INTO user_info (name,email,password,phone_number) VALUES ('$name','$email','$password','$phone')"; 
    
    mysqli_query($conn,$query);
    $_SESSION['show']='show';
    header('Location: ../login.php');
}