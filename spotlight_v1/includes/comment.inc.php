<?php session_start();?>
<?php include "../dbh.php";?>
<?php
 if(isset($_POST['addComment']) && empty($_SESSION['userid']) && empty($_SESSION['useruid'])){
    header("location: ../article.php?title={$_SESSION['currentSite']}&date={$_SESSION['currentSiteDate']}");
    exit();
  }
  else if(isset($_POST['addComment']) && $_SESSION['userid'] && $_SESSION['useruid']){
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $useridComment = $_SESSION['userid'];
    $usernameComment = $_SESSION['useruid'];
    $currentUrl = $_SESSION['currentSite'];
    $sqlQueryComment = "INSERT INTO comments (usersId, usersUid, comment, createdOn, articleTitle) VALUES ('$useridComment','$usernameComment','$comment',NOW(),'$currentUrl')";
    $resultComment = mysqli_query($conn, $sqlQueryComment);

// if(!$resultComment){
//     die('Query FAILED' . mysqli_error($conn)); 
// }
// else{
//     echo "succccess";
// }
header("location: ../article.php?title={$_SESSION['currentSite']}&date={$_SESSION['currentSiteDate']}");
    exit();
}
else{
header("location: ../index.php");
    exit();
}


    //   if(isset($_POST['addComment']) && empty($_SESSION['userid']) && empty($_SESSION['useruid'])){
    //     echo'<script>alert("Du måste vara inloggad för att kommentera");</script>';
    //   }
    //   else if(isset($_POST['addComment']) && $_SESSION['userid'] && $_SESSION['useruid']){
    //     $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    //     $useridComment = $_SESSION['userid'];
    //     $usernameComment = $_SESSION['useruid'];
    //     $sqlQueryComment = "INSERT INTO comments (usersId, usersUid, comment, createdOn, articleTitle) VALUES ('$useridComment','$usernameComment','$comment',NOW(),'$title')";
    //     $resultComment = mysqli_query($conn, $sqlQueryComment);
    // }
    // $sqlNumComments = "SELECT id FROM comments WHERE articleTitle = '$title'";
    // $resultCommentNum = mysqli_query($conn, $sqlNumComments);

    // $numComments = mysqli_num_rows($resultCommentNum);
      