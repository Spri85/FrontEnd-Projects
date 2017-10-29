<?php

//Start session and connect
session_start();
include('connection.php');

//get user_id and new email sent through Ajax
$user_id = $_SESSION['user_id'];
$newemail = $_POST['email'];

//Check if new email exists
$sql = "SELECT * FROM users WHERE email='$newemail'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
  if($count > 0){
    echo "<div class='alert alert-danger'>There is already as user registered with that email! Please choose another one!</div>";
    exit;
  }

//Get the current email
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 1){
  $row = mysqli_fetch_array($result, MYSQL_ASSOC);
  $email = $row['email'];
}else{
  echo "There was an error retriving the email from the database";
  exit;
}

//Create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

//insert new activation code in the users table
$sql = "UPDATE users SET activation2 = '$activationKey' WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
  echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>"; exit;
}else{
  //send email with link to activatenewemail.php with email, new email and activation code
  $message = "Please click on this link prove that you own this email:\n\n";
$message .= "http://spri85.000webhostapp.com/activatenewemail.php?email=" . urldecode($email) .
"&newemail=" . urldecode($newemail) .
"&key=$activationKey";

if(mail($newemail, 'Email Update for your Online Notes App', $message, 'From:' . 'viktorpar@gmail.com')){
  echo "<div class='alert alert-success'>An email has been sent to $newemail. Please click to prove ypu own that email address.</div>";
}







}
?>