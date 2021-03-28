<?php session_start();?>
<?php
if(isset($_SESSION["userid"]) && $_SESSION["useruid"]){
    session_start();
    session_unset();
    session_destroy();
    
    header("location: ./index.php");
    exit();
}
else{
    header("location: ./index.php");
    exit();
}