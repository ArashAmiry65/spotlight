<?php session_start();?>
<?php include "../dbh.php";?>
<?php

if(isset($_POST['removed'])){
    $commentID = $_POST['idComment'];
    $removeCommentQuery = "DELETE FROM comments WHERE id = $commentID";
    $resultRemoved = mysqli_query($conn, $removeCommentQuery);
    header("location: ../article.php?title={$_SESSION['currentSite']}&date={$_SESSION['currentSiteDate']}");
    exit();
}
else{
    header("location: ../index.php");
    exit();
}