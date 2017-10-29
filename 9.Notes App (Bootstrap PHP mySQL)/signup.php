<?php
session_start();
include ('connection.php');

//check user inputs
  //Define error message
$missingUsername = '<p><srong>Please enter a username!</strong></p>';
$missingEmail = '<p><srong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><srong>Please enter a valid email address</strong></p>';
$missingPassword = '<p><srong>Please enter apassword!</strong></p>';
$missingPassword2 = '<p><srong>Please confirm your password</strong></p>';
$invalidPassword = '<p><srong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword = '<p><srong>Password don\'t match!</strong></p>';
$errors = '';
$username = '';
$email = '';
$password = '';
$message = '';


//Get username, email, password, password2
//Get username
if(empty($_POST['username'])){
  $errors .= $missingUsername;
}else{
  $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}

//Get email
if(empty($_POST['email'])){
  $errors .= $missingEmail;
}else{
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors .= $invalidEmail;
  }
}

//Get password
if(empty($_POST["password"])){
  $errors .= $missingPassword;
}elseif(!((strlen($_POST["password"]) > 5) and 
        preg_match('/[A-Z]/',$_POST["password"]) and
        preg_match('/[0-9]/',$_POST["password"])
       )){
  $errors .= $invalidPassword;
}else{
  $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  if(empty($_POST["password2"])){
    $errors .= $missingPassword2;
  }else{
    $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
    if($password !== $password2){
      $errors .= $differentPassword;
    }
  }
}

//if there are any errors print error
if($errors){
  $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultMessage;
}else{

//no errors

//Prepare variables for the queries
$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
//$password = md5($password);
$password = hash('sha256', $password);
//256bits -> 64characters

//If username exist in the users table print error
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if(!$result){
  echo "<div class='alert alert-danger'>Error running the query!</div>";
  echo "<div class='alert alert-danger'>" . mysqli_error($link) . "</div>";
  exit;
}
$results = mysqli_num_rows($result);
if($results){
  echo "<div class='alert alert-dfanger'>That username is already registered. Do you want to log in?</div>";
  exit;
}

//If email exist in the usere table print error
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
  echo "<div class='alert alert-danger'>Error running the query!</div>";
  exit;
}
$results = mysqli_num_rows($result);
if($results){
  echo "<div class='alert alert-dfanger'>That email is already registered. Do you want to log in?</div>";
  exit;
}

//Create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
  //byte: unit of data = 8bits
  //bit: 0 or 1
  //16bytes = 16*8 = 128 btis
  
//Inser user details and activation code in the users table

$sql = "INSERT INTO users (username, email, password, activation) VALUES ('$username', '$email', '$password', '$activationKey')";
$resuslt = mysqli_query($link, $sql);

if(!$result){
  echo "<div class='alert alert-dfanger'>There was an error inserting the users details in the database</div>";
  exit;
}

//Send the user an email with a link to activate.php with their email and activation code
$message = "Please click on this link to activate your account:\n\n";
$message .= "http://spri85.000webhostapp.com/activate.php?email=" . urldecode($email) . "&key=$activationKey";

if(mail($email, 'Confirm your registration', $message, 'From:' . 'viktorpar@gmail.com')){
  echo "<div class='alert alert-success'>Thank for your registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>";
}
}









































?>