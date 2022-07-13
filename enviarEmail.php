<?php

use PHPMailer\PHPMailer\PHPMailer;

function enviarEmail($destinatario, $assunto, $mensagemHTML)
{

    require 'vendor/autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = '';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = '';
    $mail->Password = '';

    $mail->SMTPSecure = false;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('', "");
    $mail->addAddress($destinatario);
    $mail->Subject = $assunto;

    $mail->Body = $mensagemHTML;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }

}
?>