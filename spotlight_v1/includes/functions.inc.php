<?php

function emptyInputSignup($name, $email, $usernameLogIn, $pwd, $pwdRepeat){
    $result;
    if (empty($name) || empty($email) || empty($usernameLogIn) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidUid($usernameLogIn){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $usernameLogIn)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $usernameLogIn, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $usernameLogIn, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $usernameLogIn, $pwd){
    // Generera en verifikationsnyckel NYTT
    $vkey = md5(time() .$usernameLogIn);

    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, vkey) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $usernameLogIn, $hashedPwd, $vkey);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Skickar verifikation via Email NYTT
    $to = $email;
    $subject = "Email Verifikation SpotLight";
    $message = "<h2>SPOTLIGHT VERIFIKATION</h2><br><p>Hejsan $name!<br><br>För att möjliggöra funktioner som att kommentera måste du ha en inloggning. Verifiera dig genom att klicka på <a href='http://localhost/html/uppgifter/spotlight_v1/verifying-validation.php?vkey=$vkey'>registrera kontot!</a></p>";
        // http://arashamiry.epizy.com/
    $headers = "From: arashamiry065@gmail.com \r\n"; //EMAIL SOM WEBBHOSTEN FÖRSER DIG MED, SKA SKRIVAS IN
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


    require "../phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
    $mail->isSMTP(); // KOMMENTERA UT NÄR SIDAN SKA UT ONLINE
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';  // Protokoll för säkert utbyte av krypterad information mellan datorsystem - Transport Layer Security
    $mail->Username='arashamiry065@gmail.com';
    $mail->Password='Amiry7431';
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('arashamiry065@gmail.com', 'Arash Amiry');
    $mail->addAddress($email); // MEJLET SOM MAN VILL SKICKA TILL
    $mail->addReplyTo('arashamiry065@gmail.com');

    $mail->isHTML(true);
    $mail->Subject= $subject;
    $mail->Body= $message;

    if(!$mail->send()){
        echo "Meddelandet kunde inte skickas!";
    }

    header("location: ../signup.php?error=none");
        exit();
}

function emptyInputLogin($usernameLogIn, $pwd){
    $result;
    if (empty($usernameLogIn) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginuser($conn, $usernameLogIn, $pwd){
    $uidExists = uidExists($conn, $usernameLogIn, $usernameLogIn);

    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false && $uidExists["verified"] == 0){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true && $uidExists["verified"] == 1){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
    else{
        header("location: ../login.php?error=wronglogin");
        exit();
    }
}