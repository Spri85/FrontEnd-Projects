<?php
session_start();
if(!isset($_SESSION["user_id"])){
  header("Location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];

//get username & email
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 1){
  $row = mysqli_fetch_array($result, MYSQL_ASSOC);
  $username = $row['username'];
  $email = $row['email'];
}else{
  echo "There was an error retriving the username and email from the database";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
  <style>
    #container {
      margin-top: 100px;
    }
    
    tr{
      cursor: pointer;
    }

  </style>
</head>

<body>
  <!--    Navigation bar-->
  <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand">Online Notes</a>
        <button class="navbar-toggle" type="button" data-target="#navbarCollapse" data-toggle="collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      </div>
      <div class="navbar-collapse collapse" id="navbarCollapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Profile</a></li>
          <li><a href="#" class="hidden">Help</a></li>
          <li><a href="#" class="hidden">Contact us</a></li>
          <li><a href="mainpageloggedin.php">My Notes</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Logged in as <strong><?php echo $username; ?></strong></a></li>
          <li><a href="index.php?logout=1">Log out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--  Container-->
  <div class="container" id="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <h2>General Account Settings:</h2>
        <div class="table-responsive">
          <table class="table table-hover table-condensed table-bordered">
            <tr data-target="#updateusername" data-toggle="modal">
              <td>Username</td>
              <td><?php echo $username; ?></td>
            </tr>
            
            <tr data-target="#updateemail" data-toggle="modal">
              <td>Email</td>
              <td><?php echo $email; ?></td>
            </tr>
            
            <tr data-target="#updatepassword" data-toggle="modal">
              <td>Password</td>
              <td>hidden</td>
            </tr>
            
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--    Update username-->
  <form action="" method="post" id="updateusernameform">
    <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
                &times;
              </button>
            <h4 id="myModalLabel">
              Edit Username:
            </h4>
          </div>
          <div class="modal-body">

            <!--          Update username message from PHP file-->
            <div id="updateusernamemessage">

            </div>
            <div class="form-group">
              <label for="username" class="">Username:</label>
              <input type="text" id="username" class="form-control" name="username" placeholder="Username" maxlength="30" value="<?php echo $username; ?>">
            </div>

           
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn green" name="update username">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
</button>
            
          </div>
        </div>
      </div>
    </div>
  </form>

<!--    Update email-->
  <form action="" method="post" id="updateemailform">
    <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
                &times;
              </button>
            <h4 id="myModalLabel">
              Enter new email:
            </h4>
          </div>
          <div class="modal-body">

            <!--          Update email message from PHP file-->
            <div id="updateemailmessage">

            </div>
            <div class="form-group">
              <label for="email" class="">Email:</label>
              <input type="email" id="email" class="form-control" name="email" placeholder="Email" maxlength="50" value="<?php echo $email; ?>">
            </div>

           
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn green" name="update username">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
</button>
            
          </div>
        </div>
      </div>
    </div>
  </form>
  
  <!--    Update password-->
  <form action="" method="post" id="updatepasswordform">
    <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
                &times;
              </button>
            <h4 id="myModalLabel">
              Enter Current and New password:
            </h4>
          </div>
          <div class="modal-body">

            <!--          Update password message from PHP file-->
            <div id="updatepasswordmessage">

            </div>
            <div class="form-group">
              <label for="currentpassword" class="sr-only">Your Current Password:</label>
              <input type="password" id="currentpassword" class="form-control" name="currentpassword" placeholder="Your Current Password" maxlength="30">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Choose a Password:</label>
              <input type="password" id="password" class="form-control" name="password" placeholder="Choose a Password" maxlength="30">
            </div>
            <div class="form-group">
              <label for="password2" class="sr-only">Confirm a Password:</label>
              <input type="password" id="password2" class="form-control" name="password2" placeholder="Confirm a Password" maxlength="30">
            </div>
           
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn green" name="update username">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
</button>
            
          </div>
        </div>
      </div>
    </div>
  </form>


  <!--    Footer-->
  <div class="footer">
    <div class="container">
      <p>Developed by Viktor Copyright &copy; 2016-
        <?php echo date("Y") ?>
      </p>
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="./profile.js"></script>
</body>

</html>
