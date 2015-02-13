<?php
include('../declare.php');

$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototypes: Reflected XSS</title>
</head>
<body>
<h1>Private session information</h1>
<p id="session">Session id: <?=session_id()?></p>
<p id="value">Received value: <?=$value?></p>
<a href="<?=TGTHOST?>reflected/start">reflected XSS start</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
