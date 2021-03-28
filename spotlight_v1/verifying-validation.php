<?php include 'dbh.php';?>
<?php
if(isset($_GET['vkey'])){
    // Process för verifikation
    $vkey = $_GET['vkey'];
    $sqlSet = "SELECT * FROM users WHERE verified = 0 AND vkey = '$vkey' LIMIT 1";
    $resultSet = mysqli_query($conn, $sqlSet);
    $querySet = mysqli_num_rows($resultSet);

    if($querySet == 1){
        //Validera Email
        $updateSqlSet = "UPDATE users SET verified = 1 WHERE vkey = '$vkey' LIMIT 1";
        $updateResultSet = mysqli_query($conn, $updateSqlSet);

        if($updateResultSet){
            header("location: ../spotlight_v1/login.php?error=none");
            exit();
        }
        else{
            echo $mysqli->error;
        }
    }
    else{
        echo "Emailen är oanvändbar eller så är den redan verifierad.";
    }
}
else{
    die("Något gick fel!");
}