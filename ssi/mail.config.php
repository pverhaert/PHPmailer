<?php
// Deze SMTP configuratie is gemeenschappelijk voor alle voorbeelden
$mail = new PHPMailer(true);
$mail->CharSet 		= 'utf-8';
$mail->SMTPDebug 	= 2;
$mail->isSMTP();
$mail->Host 		= 'smtp.gmail.com';
$mail->Port 		= 587;
$mail->SMTPSecure 	= 'tls';
$mail->SMTPAuth 	= true;
$mail->Username   	= 'xxx@gmail.com';
$mail->Password 	= '***secret***';
$mail->SMTPSecure 	= 'tls';
?>