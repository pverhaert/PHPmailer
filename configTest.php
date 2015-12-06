<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer(true);
$version = $mail->Version;
if ($_POST['Submit'] <> "") {
	$smtp_server = $_POST['smtp_server'];
	$smtp_port = $_POST['smtp_port'];
	if ($_POST['smtp_secure']) {
		$smtp_secure = strtolower($_POST['smtp_secure']);
	}
	$smtp_user = $_POST['smtp_user'];	
	$smtp_password = $_POST['smtp_password'];
	$smtp_authenticate 	= $_POST['smtp_authenticate'];
	
	$from =  $_POST['from'];
	$to =  $_POST['to'];
	$subject =  $_POST['subject'];
	$body = "<p>$subject <br>Van: $from <br>Aan: $to<br><img src=\"http://lorempixel.com/400/150/\"></p>";

	// Config code
	$configCode = "// Bewaar deze code (SMTP configuratie) in 'ssi/mail.config.php'\n";
	$configCode .= "\$mail = new PHPMailer(true);\n";
	$configCode .= "\$mail->CharSet \t\t= 'utf-8';\n";
	$configCode .= "\$mail->SMTPDebug \t= 2;\n";
	$configCode .= "\$mail->isSMTP();\n";
	$configCode .= "\$mail->Host \t\t= '$smtp_server';\n";
	$configCode .= "\$mail->Port \t\t= $smtp_port;\n";
	$configCode .= "\$mail->SMTPSecure \t= '$smtp_secure';\n";
	if($smtp_authenticate != '') {
		$configCode .= "\$mail->SMTPAuth \t= true;\n";	
		$configCode .= "\$mail->Username   \t= '$smtp_user';\n";
		$configCode .= "\$mail->Password \t= '***secret***';\n";
	}
	$configCode .= "\$mail->SMTPSecure \t= '$smtp_secure';";
}
?>
<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/basis.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php require_once('ssi/head.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>PHPMailer test configuratie</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script>
$(function() {
	if ($('#smtp_authenticate').is(':not(:checked)')) $('#authDiv').hide();
		
	// toggle mailadressen
   	$('#toggle').click(function(e) {
    	var van = $('#from').val();
		$('#from').val($('#to').val());
		$('#to').val(van);
	});
	
	// SMTP auth verplicht
	$('#smtp_authenticate').click(function(e) {
        if ($(this).is(':checked')) {
			$('#authDiv').find('input').attr('required', true).end().show();
		} else {
			$('#authDiv').find('input').attr('required', false).end().hide();
		};
    });
	
	// Presets
	$('.presetBtn button').click(function(e) {
		var conf = $(this).data('conf');
        var c = conf.split(',');
		$('#smtp_server').val(c[0]);
		$('#smtp_port').val(c[1]);
		$('#smtp_secure' + c[2]).prop('checked', true);
		$('#smtp_authenticate').prop('checked', (c[3] === 'true'));
		if($('#smtp_authenticate').is(':checked')) {
			$('#authDiv').show();
			$('#smtp_user, #smtp_password').prop('required', true);
		} else {
			$('#authDiv').hide();
			$('#smtp_user, #smtp_password').prop('required', false);
		}
		$('#smtp_user').val(c[4]);
    });
});
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<!-- Menu Horizontal -->
<?php require_once('ssi/navigatie.php'); ?>
<div id="main" class="container" ><!-- InstanceBeginEditable name="data" -->
  <div class="page-header col-sm-12">
    <h1>Testform <small>PHPMailer SMTP configuratie : <?php echo $version ?></small></h1>
  </div>
  <div class="row">
    <form method="post" name="form1" id="form1">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="from">Van:</label>
          <input type="email" required name="from" id="from" placeholder="Van e-mail" value="<?php echo (isset($_POST['from'])?$_POST['from']:''); ?>">
        </div>
        <div class="form-group">
          <label for="to">Aan:</label>
          <input type="email" required name="to" id="to" placeholder="Aan e-mail" value="<?php echo (isset($_POST['to'])?$_POST['to']:''); ?>">
        </div>
        <div class="form-group">
          <label for="subject">Onderwerp:</label>
          <input type="text" required name="subject" id="subject" value="<?php echo (isset($_POST['subject'])?$_POST['subject']:'Test email'); ?>">
        </div>
        <input name="Submit" type="submit" value="Verzenden" class="btn btn-primary">
        <input type="button" name="toggle" id="toggle" value="van &lt;-&gt; aan" class="btn btn-primary">
        <p>&nbsp;</p>
<?php if ($_POST['Submit'] <> "") { ?>
<div>
<pre class="text-info">
<?php echo($configCode) ;?>
</pre>
</div>
<?php } ?>

      </div>
      <div class="col-sm-6">
        <h3>Presets</h3>
        <div class="btn-group btn-group-xs presetBtn">
          <button type="button" data-conf="smtp.gmail.com,587,1,true,xxx@gmail.com" class="btn btn-primary">Gmail</button>
          <button type="button" data-conf="smtp.hotmail.com;smtp.live.com,587,1,true,xxx@hotmail.com" class="btn btn-primary">Hotmail</button>
          <button type="button" data-conf="relay.proximus.be;relay.skynet.be,587,1,true,xxx@proximus.be" class="btn btn-primary">Proximus</button>
          <button type="button" data-conf="smtp.telenet.be,587,1,true,xxx@telenet.be" class="btn btn-primary">Telenet</button>
          <button type="button" data-conf="smtps.kuleuven.be,587,1,true,u00xxxxx" class="btn btn-primary">KU Leuven</button>
          <button type="button" data-conf="outlook.office365.com;smtp.office365.com,587,1,true,xxx@office365.com" class="btn btn-primary">Office365</button>
        </div>
        <div class="btn-group btn-group-xs presetBtn">
          <button type="button" data-conf="localhost,25,0,false," class="btn btn-info">Localhost</button>
          <button type="button" data-conf="localhost,587,1,true," class="btn btn-info">Localhost (secure)</button>
        </div>
        <p></p>
        <div class="panel panel-success">
          <div class="panel-heading">
            <h2 class="panel-title">SMTP instellingen</h2>
          </div>
          <div class="panel-body">
            <input id="smtp_debug" name="smtp_debug" type="hidden" value="2">
            <div class="form-group">
              <label for="smtp_server">SMTP Server:</label>
              <input type="text" required name="smtp_server" id="smtp_server" value="<?php echo (isset($_POST['smtp_server'])?$_POST['smtp_server']:''); ?>">
            </div>
            <div class="form-group">
              <label for="smtp_port">SMTP poort:</label>
              <input required type="text" name="smtp_port" id="smtp_port" value="<?php echo (isset($_POST['smtp_port'])?$_POST['smtp_port']:''); ?>">
            </div>
            <div>
              <label>SMTP Security:</label>
              <br>
              <label class="radio-inline">
                <input <?php if (!(strcmp($_POST['smtp_secure'],"none"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_secure" id="smtp_secure0" value="none">
                Geen </label>
              <label class="radio-inline">
                <input <?php if (!(strcmp($_POST['smtp_secure'],"tls"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_secure" id="smtp_secure1" value="tls">
                TLS </label>
              <label class="radio-inline">
                <input <?php if (!(strcmp($_POST['smtp_secure'],"ssl"))) {echo "checked=\"checked\"";} ?> type="radio" name="smtp_secure" id="smtp_secure2" value="ssl">
                SSL </label>
            </div>
            <div>
              <label>SMTP authenticatie verplicht?</label>
              <br>
              <label class="checkbox-inline">
                <input <?php if (!(strcmp($_POST['smtp_authenticate'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" id="smtp_authenticate" name="smtp_authenticate" value="1" >
                ja</label>
            </div>
          </div>
        </div>
        <div class="panel panel-success" id="authDiv">
          <div class="panel-heading">
            <h2 class="panel-title">SMTP Authenticatie</h2>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <label for="smtp_user">Authenticatie user:</label>
              <input required type="text" name="smtp_user" id="smtp_user" value="<?php echo (isset($_POST['smtp_user'])?$_POST['smtp_user']:''); ?>">
            </div>
            <div class="form-group">
              <label for="smtp_password">Authenticatie paswoord:</label>
              <input required type="password" name="smtp_password" id="smtp_password" value="<?php echo (isset($_POST['smtp_password'])?$_POST['smtp_password']:''); ?>">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
<div class="col-sm-12">
    <div id="debugInfo">
      <?php
if ($_POST['Submit'] <> "") {
	require_once 'PHPMailer/PHPMailerAutoload.php';
	// SMTP configuratie
	$mail = new PHPMailer(true);
	$mail->CharSet 		= 'utf-8';
	$mail->SMTPDebug 	= 2;
	$mail->Debugoutput 	= 'html';

	$mail->isSMTP();
	$mail->Host 		= $smtp_server;
	$mail->Port 		= $smtp_port;
	if ($_POST['smtp_secure'] <> 'none') {
		$mail->SMTPSecure 	= $smtp_secure;
	}
	if($smtp_authenticate != '') {
		$mail->SMTPAuth 	= true;
		$mail->Username   	= $smtp_user;
		$mail->Password 	= $smtp_password;
	}
	
	// From <-> To
	$mail->addReplyTo($from);
	$mail->addAddress($to);
	$mail->From 		= $from;
	$mail->Subject 		= $subject;
	
	// Basis HTML-email
	$mail->IsHTML();
	$datum = date('d-m-Y h:i:s');
	$body = <<<BODY
	<html>
	<style>
	body {font-family:Verdana, Geneva, sans-serif; font-size:12px;}
	h1 {font-size:18px;}
	img {border: none;}
	.h {color:red;}
	</style>
	<body>
	<h1>$subject</h1>
	<p>Van: <span class="h">$from</span><br>Aan: <span class="h">$to</span><p>
	<hr>
	<p><a href="https://github.com/PHPMailer/PHPMailer"><img src="assets/phpmailer.png"></a></p>
	<p>Verzonden op $datum</p>
	</body>
	</html>
BODY;
	$mail->msgHTML($body);

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
  </div>  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd -->
</html>