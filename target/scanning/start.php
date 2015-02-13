<?php
include('../declare.php');

$loggedin = false;
if (isset($_SESSION['user'])) {
  $loggedin = true;
  $messages[] = "Logged in as ".$_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attack pattern prototype: Resource scanning</title>
</head>
<body>
<h1>Resource scanning</h1>
<p>
You can log in to this website via the login link below. For demo
purposes, you can use username <b>user</b> and password <b>pwd</b>.
</p>
<?
if ($loggedin) {
?>
<p id="messages">
<?=implode('<br/>', $messages)?>
</p>
<a href="<?=TGTHOST?>login?referer=scanning/start&logout=1">log out</a>
<?
} else {
?>
<a href="<?=TGTHOST?>login?referer=scanning/start">log in</a>
<?
}
?>
<p>
Then by clicking on the ``attack'' link below, you will taken to a
malicious website that uses iframes targeting this site to conduct an
internal-resource-scanning attack.
</p>
<p>
Finally, if you log out and try again, the malicious site won't be able
to find any resources. This demonstrates that the site was piggybacking
on your prior authentication to steal resources.
</p>

<a href="<?=MALHOST?>scanning/scan">attack</a> |
<a href="<?=TGTHOST?>home">home</a>
</body>
</html>
