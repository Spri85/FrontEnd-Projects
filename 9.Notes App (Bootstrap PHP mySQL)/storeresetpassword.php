<?php
//This file recives: user_id, generated key to reset password, password1 and password2
//This file then resets password for user_id if all checks are correct

session_start();
include('connection.php');

//if user_id or reset key is missing
if(!isset($_POST['user_id']) || 
  !isset($_POST['key'])
  ){
  
  echo "<div class='alert alert-danger'>There was an error. Please click on the link you recived by email.</div>"; exit;
}
//else
  //Store them in two variables
$user_id = $_POST['user_id'];
$key = $_POST['key'];
$time = time() - 86400;

//prepare variables for the query
$user_id = mysqli_real_escape_string($link, $user_id);
$key = mysqli_real_escape_string($link, $key);

//Run query: Check combination of user_id & key exists and less than 24h old
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' and status='pending'";
$result = mysqli_query($link, $sql);          

//
if(!$result){
echo "<divclass='alert alert-danger'>Error running the query!</div>"; exit;
          }
//if combination does not exist
//show an error message
$count = mysqli_num_rows($result);
  //If the email does not exist
if($count !== 1){
  echo "<div class='alert alert-dfanger'>Please try again.</div>";
  exit;
}

//Define error messages
$missingPassword = '<p><srong>Please enter apassword!</strong></p>';
$missingPassword2 = '<p><srong>Please confirm your password</strong></p>';
$invalidPassword = '<p><srong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword = '<p><srong>Password don\'t match!</strong></p>';
$errors = '';
$password = '';
$message = '';

//Get passwords
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
    echo $resultMessage; exit;
}

//no errors
  //Prepare variables for the query
$password = mysqli_real_escape_string($link, $password);
//$password = md5($password);
$password = hash('sha256', $password);
//256bits -> 64characters
$user_id = mysqli_real_escape_string($link, $user_id);

  //Run Query: Update users password in the users table
  $sql = "UPDATE users SET password='$password' WHERE user_id = '$user_id'";
  $result = mysqli_query($link, $sql);
  
  if(!$result){
  echo "<div class='alert alert-danger'>There was a problem storing the new password in the database!</div>";
//  echo "<div class='alert alert-danger'>" . mysqli_error($link) . "</div>";
  exit;
}
  
//set the key status to "used" in the forgotpassword table to prevent the key from being used twice
$sql = "UPDATE forgotpassword SET status='used' WHERE rkey = '$key' AND user_id='$user_id'";

$result = mysqli_query($link, $sql);
  
  if(!$result){
  echo "<div class='alert alert-danger'>Error runing the query</div>";
//  echo "<div class='alert alert-danger'>" . mysqli_error($link) . "</div>";
}else{
    echo "<div class='alert alert-success'>Your password has been update successfully! <a href='index.php'>Login</a></div>";
  }
?>