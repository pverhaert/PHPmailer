<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Mailinglist</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
  <div class="page-header col-sm-12">
    <h1>Mailinglist <small>(meerdere e-mails)</small></h1>
  </div>
  <div class="col-sm-12">
  <div id="debugInfo">
<?php
require_once('PHPMailer/PHPMailerAutoload.php');
require_once('ssi/mail.config.php');
?>

<?php
// Plaats een Repeat Region rond dit PHP blok
$From 		= $mail->Username;
$FromName	= 'Mijn naam';

if ($_POST['Submit'] <> "") {
	$mail->SMTPDebug 	= 2;
	$mail->Debugoutput	= 'html';
	$mail->SetFrom		($From, $FromName);
	
	// Hier mailadres, naam van auteurs
	$mail->AddAddress	('email hier', 'naam hier');
	
  	$mail->Subject		= 'Mailinglist (meerdere e-mails)';
	
	$body = file_get_contents('mailTemplates/mailinglist.html'); 
    $body = str_replace('%Webadmin%', $FromName, $body); 
	
	$mail->IsHTML();
	$mail->MsgHTML		($body);
	
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
  <div class="col-sm-4">
    <form id="mailform" name="mailform" method="post">
      <div class="form-group">
        <label>Van: </label><br><?php echo $FromName ?> &lt;<?php echo $From ?>&gt;
      </div>
      <label></label>
      <input name="Submit" type="submit" value="Verzenden" class="btn btn-primary">
    </form>
  </div>
  <div class="col-sm-8">
    <h3>Todo</h3>
    <ul>
      <li>Maak op deze pagina een connectie met de database uit voorgaand hoofdstuk (boekengids).</li>
      <li>Voeg  uw <strong>eigen gegevens</strong> (naam, email) toe aan de tabel <strong>tbl_auteurs</strong>.</li>
      <li>Maak een recordset <strong>rsAuteurs</strong> en selecteer alle namen en mailadressen.</li>
      <li>Plaats de velden <strong>email</strong> en <strong>naam</strong> in <strong>$mail-&gt;AddAddress</strong>.</li>
      <li>Plaats een <strong>Repeat Region</strong> rond het PHP blok waarin de mail verzonden wordt.</li>
    </ul>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>
