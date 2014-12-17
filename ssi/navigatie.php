<?php
// navigatie via heredoc: http://php.net/manual/en/language.types.string.php
// $basisURL zie  ssi/head.php
$nav = <<<NAV
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigatie</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="$basisURL/"><i class="fa fa-fw fa-home"></i> Home</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/"><i class="fa fa-fw fa-envelope"></i> Voorbeelden <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="$basisURL/basisMail.php"><i class="fa fa-fw fa-file-text-o"></i> Basis e-mail</a></li>
            <li class="divider"></li>
            <li><a href="$basisURL/htmlMail_1.php"><i class="fa fa-fw fa-html5"></i> HTML e-mail (inline HTML)</a></li>
            <li><a href="$basisURL/htmlMail_2.php"><i class="fa fa-fw fa-html5"></i> HTML e-mail (HTML template)</a></li>
            <li class="divider"></li>
            <li><a href="$basisURL/dbMail_1.php"><i class="fa fa-fw fa-database"></i> Mailinglist (meerdere e-mails)</a></li>
            <li><a href="$basisURL/dbMail_2.php"><i class="fa fa-fw fa-database"></i> Mailinglist (één e-mail)</a></li>
            <li><a href="$basisURL/mailTemplates/dbMail_3.php"><i class="fa fa-fw fa-database"></i> Repeat data</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a href="/" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-question-circle"></i> Info <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="$basisURL/configTest.php"><i class="fa fa-fw fa-gear"></i> SMTP configuratie</a></li>
            <li class="divider"></li>
            <li><a href="http://phpmailer.worxware.com/?pg=tutorial"><i class="fa fa-external-link"></i>
 PHPMailer tutorial</a></li>
            <li><a href="https://github.com/PHPMailer/PHPMailer/tree/master/examples"><i class="fa fa-external-link"></i>
 PHPMailer examples</a></li>
            <li class="divider"></li>
            <li><a href="http://phpmailer.github.io/PHPMailer/classes/PHPMailer.html#properties"><i class="fa fa-external-link"></i>
 PHPMailer properties</a></li>
            <li><a href="http://phpmailer.github.io/PHPMailer/classes/PHPMailer.html#methods"><i class="fa fa-external-link"></i>
 PHPMailer methods</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
NAV;
echo $nav;
?>