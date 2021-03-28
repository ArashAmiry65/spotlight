<?php

if(isset($_POST['submitMail'])){

    require "./phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;
    $mail->isSMTP(); // KOMMENTERA UT NÄR SIDAN SKA UT ONLINE
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';  // Protokoll för säkert utbyte av krypterad information mellan datorsystem - Transport Layer Security
    $mail->Username=$_POST['mail'];
    $mail->Password=$_POST['mailPassword'];
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($_POST['mail'], $_POST['name']);
    $mail->addAddress('arahamiry065@gmail.com'); // MEJLET SOM MAN VILL SKICKA TILL
    $mail->addReplyTo($_POST['mail']);

    $mail->isHTML(true);
    $mail->Subject=$_POST['subject'];
    $mail->Body='<p font-family: "Times New Roman", Times, serif;>'.$_POST['message'].'</p>';

    if(empty($_POST['mail']) || empty($_POST['mailPassword']) || empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message'])){
        header("location: ./index.php?mail=empty");
        exit();
    }

    if(str_word_count($_POST['name']) <= 1){
        header("location: ./index.php?mail=name-error");
        exit();
    }
    if(preg_match("/[^a-z\s-]/i",$_POST['name'])){
        header("location: ./index.php?mail=name-specialchars");
        exit();
    }

    if(!$mail->send()){
        header("location: ./index.php?mail=errorsent");
        exit();
    }
    
        header("location: ./index.php?mail=sentsuccessfully");
        exit();
}
