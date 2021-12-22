<?php
require_once('home/phpmailer/SMTP.php');
require_once('home/phpmailer/PHPMailer.php');
require_once('home/phpmailer/Exception.php');

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;


function sendMail($recipient,$subject,$body,$altbody){
    $mail=new PHPMailer(true); // Passing `true` enables exceptions

    try {
        //settings
        $mail->SMTPDebug=0; // No debug output. Set 2 to have all debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host='node5-fr.n0c.com';
        $mail->SMTPAuth=true; // Enable SMTP authentication
        $mail->Username='**********@****.com'; // SMTP username : to change
        $mail->Password='*******************'; // SMTP password : to change
        $mail->SMTPSecure='ssl';
        $mail->Port=465;

        $mail->setFrom('**********@****.com', 'XVote'); // to change

        //recipient
        $mail->addAddress($recipient, 'RecipientName');     // Add a recipient

        //content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject=$subject;
        $mail->Body=$body;
        $mail->AltBody=$altbody;
        $mail->CharSet = 'UTF-8';

        $mail->send();

        // echo 'Message has been sent';
    } 
    catch(Exception $e) {
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: '.$mail->ErrorInfo;
    }
}

