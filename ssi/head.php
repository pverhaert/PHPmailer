<?php
// Controleer de server
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
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link media="all" type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link media="all" type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css">
<link media="all" type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.4.5/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.4.5/adapters/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $basisURL ?>/custom.css">
<script src="<?php echo $basisURL ?>/custom.js"></script>