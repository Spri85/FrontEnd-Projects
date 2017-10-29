<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember metaphone
include('rememberme.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Online Notes</title>
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
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
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#" class="hidden">Help</a></li>
          <li><a href="#" class="hidden">Contact us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#loginModal" data-toggle="modal">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--    Jumbotron with Sign up Button-->
  <div class="jumbotron" id="mContainer">
    <h1>Online Notes App</h1>
    <p>Your Notes with you wherever you go</p>
    <p>Easy to use, protects all your notes!</p>
    <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up-It's free</button>
  </div>

  <!--    Login form-->
  <form action="" method="post" id="loginform">
    <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
                &times;
              </button>
            <h4 id="myModalLabel">
              Login:
            </h4>
          </div>
          <div class="modal-body">

            <!--          Login message from PHP file-->
            <div id="loginmessage">

            </div>
            <div class="form-group">
              <label for="loginemail" class="sr-only">Email:</label>
              <input type="loginemail" id="loginemail" class="form-control" name="loginemail" placeholder="Email" maxlength="50">
            </div>

            <div class="form-group">
              <label for="loginpassword" class="sr-only">Password:</label>
              <input type="password" id="loginpassword" class="form-control" name="loginpassword" placeholder="Password" maxlength="30">
            </div>

            <div class="checkbox">
              <label for="">
               <input type="checkbox" name="rememberme" id="rememberme">
              Remember me
            </label>
              <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">
            Forgot password?
          </a>
            </div>

          </div>
          <div class="modal-footer">
            <input type="submit" value="Login" class="btn green" name="login">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
</button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">
              Register
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!--  Sign up form-->
  <form method="post" id="signupform">
    <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
                &times;
              </button>
            <h4 id="myModalLabel">
              Sign up today and Start using our online Notes App!
            </h4>
          </div>
          <div class="modal-body">

            <!--          Sign up message from PHP file-->
            <div id="signupmessage">

            </div>
            <div class="form-group">
              <label for="username" class="sr-only">Username:</label>
              <input type="text" id="username" class="form-control" name="username" placeholder="Username" maxlength="30">
            </div>

            <div class="form-group">
              <label for="email" class="sr-only">email:</label>
              <input type="email" id="email" class="form-control" name="email" placeholder="Email" maxlength="50">
            </div>

            <div class="form-group">
              <label for="password" class="sr-only">Choose a password:</label>
              <input type="password" id="password" class="form-control" name="password" placeholder="Password" maxlength="30">
            </div>

            <div class="form-group">
              <label for="password2" class="sr-only">Confirm password:</label>
              <input type="password" id="password2" class="form-control" name="password2" placeholder="Confirm password" maxlength="30">
            </div>

          </div>
          <div class="modal-footer">
            <input type="submit" value="Sign up" class="btn green" name="signup">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>

          </div>
        </div>
      </div>
    </div>
  </form>

  <!--    Forgot password form-->
  <form action="" method="post" id="forgotpasswordform">
    <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
                &times;
              </button>
            <h4 id="myModalLabel">
              Forgot Password? Enter your email address:
            </h4>
          </div>
          <div class="modal-body">

            <!--          Forgot password message from PHP file-->
            <div id="forgotpasswordmessage">

            </div>
            <div class="form-group">
              <label for="forgotpasswordemail" class="sr-only">Email:</label>
              <input type="email" id="forgotpasswordemail" class="form-control" name="forgotpasswordemail" placeholder="Email" maxlength="50">
            </div>

          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn green" name="login">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">
              Register
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
  <script src="./index.js"></script>
</body>

</html>
