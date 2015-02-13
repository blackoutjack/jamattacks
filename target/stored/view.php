<?php
include('../declare.php');

$values = array();
$valueres = mysql_query("SELECT id, session, value FROM stored WHERE 1 ORDER BY id");
if ($valueres) {
  while ($vals = mysql_fetch_assoc($valueres)) {
    $values[] = $vals;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototypes: Stored XSS</title>
</head>
<body>
<h1>Private session information</h1>
<p id="session">Session id: <?=session_id()?></p>
Here is a list of previously submitted values:
<ul>
<?
foreach ($values as $vals) {
?>
<li><?=$vals['id']?>: <?=$vals['value']?></li>
<?
}
?>
</ul>
<br/>
<br/>
<br/>
<a href="<?=TGTHOST?>stored/start">stored XSS start</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
