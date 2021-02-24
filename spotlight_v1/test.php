<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "spotlight";

$conn = mysqli_connect($server, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT *
FROM test
JOIN test1
  ON test.name_id = test1.name_id";

  $result = mysqli_query($conn, $query);

  while($row = mysqli_fetch_assoc($result))
{ 
  echo 
  $row['age'] . "<br>" .
  $row['name'] . "<br>" .
  $row['name_id'] . "<br>" .
  $row['posts_id'] . "<br>" .
  $row['name_id'] . "<br>" .
  $row['post_author'] . "<br>" ;
}