<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>HTML mail</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
  <div class="page-header col-sm-12">
    <h1>HTML e-mail <small>(HTML template)</small></h1>
  </div>
  <div class="col-sm-12">
  <div id="debugInfo">
<?php

require_once('PHPMailer/PHPMailerAutoload.php');
require_once('ssi/mail.config.php');

$From 		= $mail->Username;
$FromName	= 'Mijn naam';

if ($_POST['Submit'] <> "") {
	$mail->SMTPDebug 	= 2;
	$mail->Debugoutput	= 'html';
	$mail->SetFrom		($From, $FromName);
	
	$mail->AddAddress	($_POST["aanEmail"], $_POST["aanNaam"]);
  	$mail->Subject		= 'Bevestiging ...';
	
	  $body = file_get_contents('mailTemplates/support.html'); 
    $body = str_replace('%naam%', $_POST["aanNaam"], $body); 
    $body = str_replace('%email%', $_POST["aanEmail"], $body); 
	
	$mail->IsHTML();
	$mail->MsgHTML($body);
	
	try {
		$mail->Send();
		echo "<div class='alert alert-success'><p>E-mail verzonden.</p></div>";
	} catch (phpmailerException $e) {
		echo "<div class='alert alert-danger'><p>E-mail NIET verzonden:</p>";
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
		echo "</div>";
	} catch (Exception $e) {
		echo "<div class='alert alert-danger'><p>E-mail NIET verzonden:</p>";
		echo $e->getMessage(); //Boring error messages from anything else!
		echo "</div>";
	}
}
?>
  </div>
  </div>
  <div class="col-sm-4">
    <form id="mailform" name="mailform" method="post">
      <div class="form-group">
        <label>Van: </label><br><?php echo $FromName ?> &lt;<?php echo $From ?>&gt;
      </div>
      <div class="form-group">
        <label for="aanNaam">Aan:</label>
        <input type="text" required name="aanNaam" id="aanNaam" value="<?php echo $_POST['aanNaam']; ?>">
      </div>
      <div class="form-group">
        <label for="aanEmail">Aan e-mail:</label>
        <input type="email" required name="aanEmail" id="aanEmail" value="<?php echo $_POST['aanEmail']; ?>">
      </div>
      <label></label>
      <input name="Submit" type="submit" value="Verzenden" class="btn btn-primary">
    </form>
  </div>
  <div class="col-sm-8">
    <h3>Snippets</h3>
    <pre class="text-info">
<?php
$code = <<<'CODE'
// 'mailTemplate.html' is een standaard HTML pagina (met interne CSS!).
// Elke variabele wordt omsloten door een procentteken, bv: %naam%, %email%, ...

// Lees het bestand
$body = file_get_contents('mailTemplate.html');
// Vervang de variabelen
$body = str_replace('%naam%', $_POST["aanNaam"], $body); 
$body = str_replace('%email%', $_POST["aanEmail"], $body); 
// Zend de mail
$mail->IsHTML();
$mail->MsgHTML ($body);
CODE;
echo $code;
?>
  </pre>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>
