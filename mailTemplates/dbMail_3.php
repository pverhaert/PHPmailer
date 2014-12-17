<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('../ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Repeat data</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('../ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
  <div class="page-header col-sm-12">
    <h1>Repeat data</h1>
  </div>
  <div class="col-sm-12">
  <div id="debugInfo">
<?php

require_once('../PHPMailer/PHPMailerAutoload.php');
require_once('../ssi/mail.config.php');

$From 		= $mail->Username;
$FromName	= 'Mijn naam';

if ($_POST['Submit'] <> "") {
	$mail->SMTPDebug 	= 2;
	$mail->Debugoutput	= 'html';
	$mail->SetFrom		($From, $FromName);
	
	$mail->AddAddress	($_POST["aanEmail"], $_POST["aanNaam"]);
  	$mail->Subject		= 'Repeat data';
	
	$mail->IsHTML();
	
	// Laad de pagina in een buffer en plaats deze in $data
	ob_start();
	require_once 'overzichtBoeken.php';
	$body = ob_get_contents();
	ob_end_clean();
	
	$body = str_replace('%naam%', $_POST["aanNaam"], $body);
	$body = str_replace('%Webadmin%', $FromName, $body);
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
    <h3>Database</h3>
    <ul>
      <li>Maak op de pagina <strong>overzichtBoeken.php</strong> een connectie met de database uit voorgaand hoofdstuk (boekengids).</li>
      <li>Vul de tabel met de <strong>titels, de namen van de auteurs en de ISBN-nummers</strong>.<br>
      (Je kan deze pagina rechtstreeks in een browser openen.)</li>
    </ul>
    <h3>Broncode</h3>
    <ul>
      <li>Op deze pagina hoeft u verder niets aan te passen.</li>
      <li>Deze pagina en <strong>overzichtBoeken.php</strong> staan in <strong>DEZELFDE map</strong>. <br>
      Zo niet krijg je problemen met het connectiescript van de database!</li>
      <li>De pagina <strong>overzichtBoeken.php</strong> wordt via de bufferfunctie <strong>ob_start()</strong> in <strong>$body</strong> geladen.<br>
        De variabelen worden ingevuld en vervolgens wordt de mail verzonden.
      </li>
    </ul>
    <pre class="text-info">&lt;?php	<br>	...
	// Laad de pagina in een buffer en plaats deze in $data<br>	ob_start();<br>	require_once 'overzichtBoeken.php';<br>	$body = ob_get_contents();<br>	ob_end_clean();<br>	<br>	$body = str_replace('%naam%', $_POST[&quot;aanNaam&quot;], $body);<br>	$body = str_replace('%Webadmin%', $FromName, $body);<br>	$mail-&gt;MsgHTML		($body);
	...<br>?&gt;</pre>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>
