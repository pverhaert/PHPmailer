<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>HTML mail</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script>
$(function(){
	// ckeditor http://ckeditor.com/latest/samples/plugins/toolbar/toolbar.html
	$('textarea').ckeditor({
		format_tags : 'h2;h3;h4;p',
		toolbar: [
			['BulletedList', 'NumberedList', 'Bold', 'Italic', 'Image', '-', 'Link', 'Unlink' ],
			[ 'Paste', 'PasteText', 'PasteFromWord', '-', 'RemoveFormat', '-', 'Undo', 'Redo', '-', 'Smiley', 'SpecialChar'],
			'/',
			[ 'Format', 'Font', 'FontSize', '-', 'Maximize', 'Source' ]
		]
	});
})
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
  <div class="page-header col-sm-12">
    <h1>HTML e-mail <small>(inline HTML)</small></h1>
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
  	$mail->Subject		= $_POST["onderwerp"];
	
	$mail->IsHTML();
	$mail->MsgHTML		($_POST["body"] . '<img src="assets/phpmailer_mini.png">');
	$mail->addAttachment('assets/phpmailer.png', 'logo PHPmailer');
	
	try {
		$mail->Send();
		echo "<div class='alert alert-success'><p>E-mail verzonden.</p></div>";
	} catch (phpmailerException $e) {
		echo "<div class='alert alert-danger'><p>E-mail NIET verzonden:</p>";
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
		echo "</div>";
	} catch (Exception $e) {
		echo "<div class='alert alert-danger'><p>E-mail NIET verzonden:</p>";
		echo $e->getMessage(); //Pretty error messages from PHPMailer
		echo "</div>";
	}
}
?>
  </div>
  </div>
  <div class="col-sm-7">
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
      <div class="form-group">
        <label for="onderwerp">Onderwerp:</label>
        <input type="text" required name="onderwerp" id="onderwerp" value="<?php echo $_POST['onderwerp']; ?>">
      </div>
      <div class="form-group">
        <label for="body">Body:</label>
        <textarea required class="form-control" rows="3" name="body" id="body"><?php echo $_POST['body']; ?></textarea>
      </div>
      <label></label>
      <input name="Submit" type="submit" value="Verzenden" class="btn btn-primary">
    </form>
  </div>
  <div class="col-sm-5">
    <h3>Snippets</h3>
    <pre class="text-info">
<?php
$code = <<<'CODE'
// Formulier met enkel een tekstboodschap
$mail->Body	= 'Tekstboodschap';

// Formulier met multipart tekst en HTML boodschap
$mail->IsHTML();
$mail->AltBody	= 'Tekstversie van de boodschap';
$mail->Body	= '&lt;p&gt;HTML versie van de boodschap&lt;/p&gt;
&lt;p&gt;img src="/assets/phpmailer_mini.png"&gt;';

// Tekstversie is nu een gestripte HTML-versie
$mail->IsHTML();
$mail->MsgHTML	('&lt;p&gt;HTML + tekstversie van de boodschap&lt;/p&gt;
&lt;p&gt;img src="/assets/phpmailer_mini.png"&gt;');

// Bijlage toevoegen (naam is optioneel)
$mail->addAttachment('/assets/phpmailer.png', 'logo PHPmailer');
$mail->addAttachment('/assets/phpmailer_mini.png');
CODE;
echo $code;
?>
  </pre>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>
