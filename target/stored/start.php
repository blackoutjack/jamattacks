<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototype: Stored XSS</title>
</head>
<body>
<h1>Stored XSS</h1>
<p>
Click on the ``attack'' link below will take you to a malicious website
that will provide instructions for acting as a malicious client to
conduct a stored XSS exploit to inject JavaScript code into another page
on this site. The ``view'' link navigates directly to that page.
</p>
<a href="<?=MALHOST?>stored/attack">attack</a> |
<a href="<?=TGTHOST?>stored/view">view</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
