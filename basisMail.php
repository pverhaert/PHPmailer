<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Tekst mail</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
  <div class="page-header col-sm-12">
    <h1>Basis e-mail <small>(tekst- of HTML boodschap)</small></h1>
  </div>
  <div class="col-sm-12">
  <div id="debugInfo">
<?php
if ($_POST['Submit'] <> "") {
	require_once('PHPMailer/PHPMailerAutoload.php');
  	require_once('ssi/mail.config.php');
	$mail->SMTPDebug 	= 2;
	$mail->Debugoutput	= 'html';
	$mail->SetFrom		($_POST["vanEmail"], $_POST["vanNaam"]);
  	$mail->AddReplyTo	($_POST["vanEmail"], $_POST["vanNaam"]);
	
	$mail->Priority 	= $_POST["prioriteit"];
	$mail->AddAddress	($_POST["aanEmail"], $_POST["aanNaam"]);
	if ($_POST["cc"] != '') {
		$mail->AddCC		($_POST["cc"]);
	}
  	$mail->Subject		= $_POST["onderwerp"];
	$mail->Body    		= $_POST["body"];
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
        <label for="vanNaam">Van:</label>
        <input name="vanNaam" type="text" required id="vanNaam" value="<?php echo $_POST['vanNaam']; ?>">
      </div>
      <div class="form-group">
        <label for="vanEmail">Van e-mail:</label>
        <input type="email" required name="vanEmail" id="vanEmail" value="<?php echo $_POST['vanEmail']; ?>">
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
        <label for="cc"> CC:</label>
        <input type="email" name="cc" id="cc" value="<?php echo $_POST['cc']; ?>">
      </div>
      <div class="form-group">
        <label for="prioriteit">Prioriteit:</label>
        <select name="prioriteit" id="prioriteit" class="form-control">
          <option value="3" <?php if (!(strcmp(3, $_POST['prioriteit']))) {echo "selected=\"selected\"";} ?>>Normaal (3)</option>
          <option value="1" <?php if (!(strcmp(1, $_POST['prioriteit']))) {echo "selected=\"selected\"";} ?>>Hoog (1)</option>
          <option value="5" <?php if (!(strcmp(5, $_POST['prioriteit']))) {echo "selected=\"selected\"";} ?>>Laag (5)</option>
        </select>
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
  <div class="col-sm-8">
    <h3>Snippets</h3>
    <pre class="text-info">
<?php
$code = <<<'CODE'
// import PHPMailer en gemeenschappelijk config-script
require_once('PHPMailer/PHPMailerAutoload.php');
require_once('mail.config.php');

// Debug opties 0: off (default), 1: client output, 2: client en server output
$mail->SMTPDebug 	= 2;
$mail->Debugoutput	= 'html';

// Default afzender is $mail->Username
// Afzender wijzigen via SetFrom() OF via From en FromName
$mail->SetFrom		('from@example.com', 'From Name'); 	// methode 1
//$mail->From 		= 'from@example.com';		 	// methode 2
//$mail->FromName     	= 'From Name';				// methode 2
$mail->AddReplyTo	('from@example.com', 'From Name');

// Meerdere geadresseerden, CC's en BCC's mogelijk (naam is telkens optioneel)
$mail->AddAddress	('person1@example.com', 'Person 1');
$mail->AddAddress	('person2@example.com');
$mail->AddCC		('person3@example.com', 'Person 3');
$mail->AddCC		('person4@example.com');
$mail->AddBCC		('person5@example.com', 'Person 5');
$mail->AddBCC		('person6@example.com');

// Prioriteit (optioneel) 1: hoog, 3: normaal, 5: laag
$mail->Priority 	= 3;

// Onderwerp en boodschap (tekst of HTML)
$mail->Subject		= 'Onderwerp van de mail';
$mail->Body    		= '&lt;p&gt;De boodschap&lt;br&gt;Lijn 2&lt;/p&gt;';

// Foutafhandeling
try {
 	$mail->Send();
  	echo "E-mail verzonden.";
} catch (phpmailerException $e) {
	echo "E-mail NIET verzonden!";
  	echo $e->errorMessage();	//Pretty error messages from PHPMailer
} catch (Exception $e) {
	echo "E-mail NIET verzonden!";
  	echo $e->getMessage();		//Boring error messages from anything else!
}
CODE;
echo $code;
?>
  </pre>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>
