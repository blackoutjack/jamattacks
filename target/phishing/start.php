<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototype: Phishing</title>
</head>
<body>
<h1>Phishing</h1>
<p>
By clicking on the ``attack'' link below, you will taken to a malicious
website that mimics a submission form on this website.
XSS attack. The ``real'' link displays the true submission form.
</p>
<a href="<?=MALHOST?>phishing/phish">attack</a> |
<a href="<?=TGTHOST?>phishing/target">real</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
