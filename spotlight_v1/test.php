<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test</title>
</head>
<body>
  <form method="post">
    <input name="tests" type="text">
    <input name="submit" type="submit">
  </form>
  <?php
  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  
  $conn = mysqli_connect($server, $username, $password, $dbname);
  mysqli_set_charset($conn,"utf8");

 
  if(isset($_POST['submit'])){
    $submitted = $_POST['tests'];
    $submitted = filter_var($submitted,FILTER_SANITIZE_SPECIAL_CHARS);
    $qurry = "INSERT INTO nms (nas) VALUES ('$submitted')";
    $resulti = mysqli_query($conn, $qurry);

    $qurrry = "SELECT * FROM nms";
    $resulty = mysqli_query($conn, $qurrry);
    
    while($low = mysqli_fetch_assoc($resulty)){
      echo $low['nas'] . "<br>";
    }
  }
  ?>
</body>
</html>

<?php

// $server = "localhost";
// $username = "root";
// $password = "";
// $dbname = "spotlight";

// $conn = mysqli_connect($server, $username, $password, $dbname);
// mysqli_set_charset($conn,"utf8");

// if(!$conn){
//     die("Connection failed: " . mysqli_connect_error());
// }

// $query = "SELECT *
// FROM test
// JOIN test1
//   ON test.name_id = test1.name_id";

//   $result = mysqli_query($conn, $query);

//   while($row = mysqli_fetch_assoc($result))
// { 
//   echo 
//   $row['age'] . "<br>" .
//   $row['name'] . "<br>" .
//   $row['name_id'] . "<br>" .
//   $row['posts_id'] . "<br>" .
//   $row['name_id'] . "<br>" .
//   $row['post_author'] . "<br>" ;
// }
?>