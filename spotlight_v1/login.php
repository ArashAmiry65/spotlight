<?php session_start(); ?>
<?php include 'dbh.php'; ?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="./includes/signup.css">
    <link rel="stylesheet" href="./includes/index.css">
    <link rel="stylesheet" href="./includes/login.css">
    <link rel="stylesheet" href="./includes/1199px-index.css">
    <link rel="stylesheet" href="./includes/768px-index.css">
    <link rel="stylesheet" href="./includes/340px-index.css">
    <link rel="stylesheet" href="./includes/1199px-login.css">
    <link rel="stylesheet" href="./includes/768px-login.css">
    <link rel="stylesheet" href="./includes/400px-login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Changa+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Spotlight | Startsida</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="."><b>Spotlight</b></a>
      
        <div id="navbarTogglerDemo02" class="mx-auto">
          <ul class="navbar-nav mr-auto pt-1 mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">RELEASE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">INTERVJUER</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">MUSIK</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">INLOGGNING</a>
            </li>
          </ul>
        </div>
        
      </nav>

  <?php
  
  if(isset($_SESSION["userid"]) && $_SESSION["useruid"]){
    header("location: ./index.php");
        exit();
  }
  else{

    echo "<section class='signup-form'>
    <h2>Logga in på Spotlight</h2>
    <form action='includes/login.inc.php' method='post'>
    <input type='text' name='uid' placeholder='Användarnamn/Email...'>
    <input type='password' name='pwd' placeholder='Lösenord...'>
    <input class='submit-button' type='submit' name='submit' value='Logga in'>
    <h6><a href='signup.php'>Registrera dig?</a></h6> 
    </form>";

    if(isset($_GET["error"])){
      if($_GET["error"] == "emtyinput"){
      echo "<p>Alla fält är obligatoriska.</p>";
      }
      else if($_GET["error"] == "wronglogin"){
        echo "<p>Felaktig inloggningsinformation eller inte verifierad.</p>";
      }
    }
    echo "</section>";
  }
  ?>
    

</body>
</html>