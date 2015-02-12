<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototypes: DOM-based XSS</title>
</head>
<body>
<h1>DOM-based XSS</h1>
<p>
By clicking on the ``attack'' link below, you will taken to a malicious
website that embeds a different page on this site to conduct a DOM-based
XSS attack. The ``clean'' link will display the same page without the
embedding attack.
</p>
<a href="<?=MALHOST?>dombased/embed">attack</a> |
<a href="<?=TGTHOST?>dombased/target">clean</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
