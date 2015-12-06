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
$From 		= $mail->Username;
$FromName	= 'Mijn naam';

if ($_POST['Submit'] <> "") {
	$mail->SMTPDebug 	= 2;
	$mail->Debugoutput	= 'html';
	$mail->SetFrom		($From, $FromName);
	
  	$mail->Subject		= 'Mailinglist (meerdere e-mails)';
	
	$body = file_get_contents('mailTemplates/mailinglist.html'); 
    $body = str_replace('%Webadmin%', $FromName, $body); 
	
	$mail->IsHTML();
	$mail->MsgHTML		($body);
	
	// Hou de connectie open tot alle mails verstuurd zijn !!!!
	$mail->SMTPKeepAlive = true;
?>

<?php	
	// Vul hier het mailadres en de naam van de auteur in.
	// Plaats vervolgens een Repeat Region rond DIT PHP-blok
	$mail->AddAddress	('email hier', 'naam hier');
	
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
	// Wis het mailadres, zoniet wordt de lijst gewoon aangevuld vanuit de loop! 
	$mail->clearAddresses()
?>

<?php
	// Stur de connectie zodra alle mails verzonden zijn.
	$mail->smtpClose();
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
    <h3>Database</h3>
    <ul>
      <li>Maak op deze pagina een connectie met de database uit voorgaand hoofdstuk (boekengids).</li>
      <li>Voeg  uw <strong>eigen gegevens</strong> (naam, email) toe aan de tabel <strong>tbl_auteurs</strong>.</li>
      <li>Maak een recordset <strong>rsAuteurs</strong> en selecteer alle namen en mailadressen.</li>
    </ul>
    <h3>Broncode aanpassen</h3>
    <ul>
      <li>Plaats de velden <strong>email</strong> en <strong>naam</strong> in <strong>$mail-&gt;AddAddress</strong>.</li>
      <li>Plaats een <strong>Repeat Region</strong> rond het PHP blok waarin de mail verzonden wordt.</li>
      <li>Merk op dat we de connectie met de mailserver <strong>open houden tot alle mails verzonden zijn</strong>!<br>
        Voor een uitgebreide  mailinglist geeft dit een aanzienlijke snelheidswinst.</li>
    </ul>
    <pre class="text-info">&lt;?php do { ?&gt;<br>&lt;?php	<br>	// Vul hier het mailadres en de naam van de auteur in.<br>	// Plaats vervolgens een Repeat Region rond DIT PHP-blok<br>	$mail-&gt;AddAddress	($row_rsAuteurs['email'], $row_rsAuteurs['naam']);<br>	<br>	try {<br>		$mail-&gt;Send();<br>		...<br>	} catch (phpmailerException $e) {<br>		echo $e-&gt;errorMessage(); //Pretty error messages from PHPMailer<br>		...<br>	} catch (Exception $e) {<br>		echo $e-&gt;getMessage(); //Pretty error messages from PHPMailer<br>		...<br>	}<br>	// Wis het mailadres, zo niet wordt de lijst gewoon aangevuld vanuit de loop! <br>	$mail-&gt;clearAddresses()<br>?&gt;<br>&lt;?php } while ($row_rsAuteurs = mysql_fetch_assoc($rsAuteurs)); ?&gt;</pre>
  </div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>
