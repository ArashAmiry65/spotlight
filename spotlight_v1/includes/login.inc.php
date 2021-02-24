<?php

if(isset($_POST["submit"])){

    $usernameLogIn = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once '../dbh.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($usernameLogIn, $pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginuser($conn, $usernameLogIn, $pwd);
}
else{
    header("location: ../login.php");
    exit();
}