<?php
session_start();
include('connection.php');
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Activation</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      .contactForm {
        border: 1px solid #1186d4;
        border-radius: 15px;
        margin: 50px;
      }

    </style>
  </head>
  <body>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-2 contactForm">
          <h1>Account Activation</h1>

          <?php 
          //if email ar activation code is missing show an arror
if(!isset($_GET['email']) || 
  !isset($_GET['key'])
  ){
  echo "<div class='alert alert-danger'>There was an error. Please click on the activation you recived by email.</div>"; exit;
}
//else
  //Store them in two variables
$email = $_GET['email'];
$key = $_GET['key'];

//prepare variables for the query
$email = mysqli_real_escape_string($link, $email);
$key = mysqli_real_escape_string($link, $key);

//Run query: set activation field to "activated" for the provided email
$sql = "UPDATE users SET activation='activated' WHERE(email = '$email' AND activation='$key') LIMIT 1";
$result = mysqli_query($link, $sql);          

//If query is successful, show success message and invite user to login
if(mysqli_affected_rows($link) == 1){
  //Show success message
  echo "<div class='alert alert-success'>Your account has been activated.</div>";
  echo "<a href='index.php' type='button' class='btn btn-lg btn-success'>Log in</a>";
}else{
  //Show error message
  echo "<div class='alert alert-danger'>Your account could not beactivated. Please try again later.</div>";
  echo "<div class='alert alert-danger'>" . mysqli_error($link)  ."</div>";
  
}
          ?>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
  </html>
