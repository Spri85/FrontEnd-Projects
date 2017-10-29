<?php
session_start();
if(!isset($_SESSION["user_id"])){
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>My Notes</title>
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
  <style>
    #container {
      margin-top: 120px;
    }
    
    #notePad,
    #allNotes,
    #done,
    .delete
    {
      display: none;
    }
    
    .buttons {
      margin-bottom: 20px;
    }
    
    textarea {
      width: 100%;
      max-width: 100%;
      border-radius: 15px;
      font-size: 16px;
      line-height: 1.5em;
      border-left-width: 20px;
      border-color: #CA3DD9;
      color: #CA3DD9;
      background-color: #FBEFFF;
      padding: 10px;
    }
    
    .noteheader{
      border: 1px solid grey;
      border-radius: 10px;
      margin-bottom: 10px;
      cursor: pointer;
      padding: 0 10px;
      background: linear-gradient(#fff, #ECEAE7);
    }
    .text{
      font-size: 20px;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
    .timetext{
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
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
          <li><a href="profile.php">Profile</a></li>
          <li><a href="#" class="hidden">Help</a></li>
          <li><a href="#" class="hidden">Contact us</a></li>
          <li class="active"><a href="#">My Notes</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Logged in as <strong><?php echo $_SESSION["username"]; ?></strong></a></li>
          <li><a href="index.php?logout=1">Log out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--  Container-->
  <div class="container" id="container">
<!--   Alert Message-->
   <div id="alert" class="alert alert-danger collapse">
     <a class="close" data-dismiss="alert">
       &times;
     </a>
     <p id="alertContent">
       
     </p>
   </div>
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <div class="buttons">
          <button id="addNote" type="button" class="btn btn-info btn-lg">Add Note</button>
          <button id="edit" type="button" class="btn btn-info btn-lg pull-right">Edit</button>
          <button id="done" type="button" class="btn btn-lg green pull-right">Done</button>
          <button id="allNotes" type="button" class="btn btn-lg btn-info">All notes</button>
        </div>

        <div id="notePad">
          <textarea rows="10"></textarea>
        </div>

        <div id="notes" class="notes">
          <!--        Ajax call to a php file-->

        </div>
      </div>
    </div>
  </div>

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
  <script src="./mynotes.js"></script>
</body>

</html>
