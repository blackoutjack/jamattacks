<?php
include('../declare.php');

$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : false;
if ($value) {
  $valuedb = mysql_real_escape_string($value);
  $sessiondb = mysql_real_escape_string(session_id());
  mysql_query("INSERT INTO stored (session, value) VALUES ('$sessiondb', '$valuedb');");
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
<?
if ($value) {
?>
  The value you submitted has been stored.
<?
} else {
?>
  No value was submitted.
<?
}
?>
<br/>
You can go here to view previously submitted values: <a href="<?=TGTHOST?>/stored/view">view</a>
<br/>
<br/>
<a href="<?=TGTHOST?>stored/start">stored XSS start</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
