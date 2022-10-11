<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendingEmail($email_to, $subject, $msg){
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        $email_sender = 'spacelymail@gmail.com';
        $name_sender = 'spacely';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email_sender;
        $mail->Password = 'yzwwkzyvadrghjix';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 3;

        $mail->setFrom($email_sender, $name_sender);
        $mail->addAddress($email_to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            )
            );

        $status = $mail->send();
        if(!$status){
            $email_sender = 'spacelymail@gmail.com';
            $name_sender = 'spacely';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $email_sender;
            $mail->Password = 'kvvihkrowljjysmm';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 587;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPDebug = 3;

            $mail->setFrom($email_sender, $name_sender);
            $mail->addAddress($email_to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false
                )
                );

            $status = $mail->send();
        }
        
        return $status;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}