<?php
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $usernameLogIn = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once '../dbh.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $email, $usernameLogIn, $pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($usernameLogIn) !== false){
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $usernameLogIn, $email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    if(str_word_count("$name") <= 1){
        header("location: ../signup.php?error=invalidnamelength");
        exit();
    }
    if(preg_match("/[^a-z\s-]/i",$name)){
        header("location: ../signup.php?error=specialcharname");
        exit();
    }
    if (strlen($pwd) < '8') {
        header("location: ../signup.php?error=invalidlength");
        exit();
    }
    if(!preg_match("#[0-9]+#",$pwd)) {
        header("location: ../signup.php?error=invalidnumber");
        exit();
    }
    if(!preg_match("#[A-Z]+#",$pwd)) {
        header("location: ../signup.php?error=invalidcapitalletter");
        exit();
    }
    if(!preg_match("#[a-z]+#",$pwd)) {
        header("location: ../signup.php?error=invalidlowercase");
        exit();
    }

    createUser($conn, $name, $email, $usernameLogIn, $pwd);
}
else{
    header("location: ../signup.php");
    exit();
}        