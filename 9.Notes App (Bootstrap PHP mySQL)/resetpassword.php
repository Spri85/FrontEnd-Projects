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
    <title>Password reset</title>

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
          <h1>Reset Password:</h1>
          <div id="resultmessage"></div>

          <?php 
          //if user_id or reset key is missing
if(!isset($_GET['user_id']) || 
  !isset($_GET['key'])
  ){
  echo "<div class='alert alert-danger'>There was an error1. Please click on the link you recived by email.</div>"; exit;
}
//else
  //Store them in two variables
$user_id = $_GET['user_id'];
$key = $_GET['key'];
$time = time() - 86400;

//prepare variables for the query
$user_id = mysqli_real_escape_string($link, $user_id);
$key = mysqli_real_escape_string($link, $key);

//Run query: Check combination of user_id & key exists and less than 24h old
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
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

//print reset password form with hidden user_id and key fields
echo "
  <form method='post' id='passwordreset'>
  <input type='hidden' name='key' value='$key'>
  <input type='hidden' name='user_id' value='$user_id'>
  <div class='form-group'>
  <label for='password'>Enter new Password:</label>
  <input type='password' name='password' id='password' placeholder='Enter Password' class='form-control'>
  </div>
  
  <div class='form-group'>
  <label for='password2'>Re-enter Password:</label>
  <input type='password' name='password2' id='password2' placeholder='Re-enter Password' class='form-control'>
  </div>
  
  <input type='submit' name='resetpassword' class='btn btn-success btn-lg' value='Reset Password'>
  </form>
";
          
          
          ?>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
<!--    Script for Ajax Call to storeresetpassword.php which processes from data-->
<script>
  //Once the form is submitted
  $("#passwordreset").submit(function(event) {
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    //send them to storeresetpassword.php using AJAX
    $.ajax({
      url: "storeresetpassword.php",
      type: "POST",
      data: datatopost,
      success: function(data) {
        $('#resultmessage').html(data);
      },
      error: function() {
        $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
      }
    })
  });
</script>
  </body>
  </html>
