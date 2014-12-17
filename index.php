<!doctype html>
<html><!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>PHPmailer homepage</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
<div class="page-header col-sm-12">
  <h1>PHPMailer <small>inleiding</small></h1>
</div>
<div class="col-md-8">
  <p><span id="result_box" lang="nl">PHPMailer is een code bibliotheek om veilig en gemakkelijk e-mails te verzenden via php.</span></p>
  <h3><span lang="nl">Hoe ga je te werk?</span></h3>
  <ul>
  <li>Controleer het basispad <strong>$basisURL</strong> in <strong>ssi/head.php</strong><br>
<pre>
$serverName = $_SERVER['SERVER_NAME'];
switch($serverName){
   // Testserver met subfolder PHP_email
   case 'localhost':
      $basisURL = '/PHP_email';
      break;
   // Productieserver zonder subfolder
   default:
      $basisURL = '';
}
</pre></li>
    <li>Download de PHPMailer bibliotheek via <a href="https://github.com/Synchro/PHPMailer">https://github.com/Synchro/PHPMailer</a></li>
    <li>Leg een verwijzing naar <strong>PHPMailerAutoload.php</strong><br>
<code>
require_once('ssi/mail.config.php');
</code></li>
    <li>Bepaal de voor u meest geschikte <a href="configTest.php">SMTP configuratie</a>.</li>
    <li>Bewaar deze configuratie in <strong>ssi/mail.config.php.<br>
    </strong>(Alle voorbeelden uit deze website maken gebruik van dezelfde configuratie.)</li>
    <li>Leg een verwijzing naar  <strong>ssi/mail.config.php.</strong>.</li>
<code>
require_once('PHPMailer/PHPMailerAutoload.php');
</code>    <li>Vervolledig het mailscript aan de hand van bijgevoegde voorbeelden.
    </li>
  </ul>
  <h3>Beperkingen Gmail</h3>
  
  <ul>
    <li>Beveiliging via laatste <a href="https://support.google.com/mail/answer/45938?hl=nl">accountactiviteit</a></li>
    <li><a href="https://support.google.com/mail/answer/22370?hl=nl">E-mail verzenden vanaf een ander adres of een alias</a></li>
  </ul>
</div>
<div class="col-md-4">
  <p><a href="https://github.com/Synchro/PHPMailer"><img class="img-responsive img-rounded" src="assets/phpmailer.png" alt="PHPmailer logo"></a></p>
  <ul>
    <li><a href="https://github.com/Synchro/PHPMailer">https://github.com/Synchro/PHPMailer</a></li>
    <li><a href="http://phpmailer.github.io/PHPMailer/">http://phpmailer.github.io/PHPMailer/</a></li>
  </ul>
  <p>&nbsp;</p>
</div>
<!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>