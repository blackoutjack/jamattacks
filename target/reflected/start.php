<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototype: Reflected XSS</title>
</head>
<body>
<h1>Reflected XSS</h1>
<p>
By clicking on the ``attack'' link below, you will taken to a malicious
website that links back to a page on this domain that contains a
reflected XSS attack. The ``clean'' link will display the same page
sans attack.
</p>
<a href="<?=MALHOST?>reflected/reflect">attack</a> |
<a href="<?=TGTHOST?>reflected/target">clean</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
