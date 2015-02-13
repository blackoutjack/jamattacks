<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototype: Trojan</title>
</head>
<body>
<h1>Trojan</h1>
<p>
By clicking on the ``attack'' link below, you will taken to another page
on this website that utilizes a script from a malicious site.
</p>
<a href="<?=TGTHOST?>trojan/target">clean</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
