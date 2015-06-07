<?php
include('../declare.php');

$loggedin = false;
$errors = array();
if (isset($_SESSION['user'])) {
  $loggedin = true;
  $errors[] = "Logged in as <b>".$_SESSION['username']."</b>";
}

$title = "Attack pattern prototype: Resource scanning"; 
include(INCDIR.'header.php');
?>
<h1>Resource scanning</h1>
<p class="login">
<?
if (sizeof($errors) > 0) {
?>
<p id="error"><?=implode(' | ', $errors)?></p>
<?
}
if ($loggedin) {
?>
 <a href="<?=TGTROOT?>login?referer=scanning/start&logout=1">log out</a>
<?
} else {
?>
 <a href="<?=TGTROOT?>login?referer=scanning/start">log in</a>
<?
}
?>
</p>
<p class="instructions">
You can log in to this website via the login link above. For demo
purposes, you can use username <b>user</b> and password <b>pwd</b>.
</p>
<p class="instructions">
Then by clicking on the ``attack'' link below, you will taken to a
malicious website that uses iframes targeting this site to conduct an
internal-resource-scanning attack.
</p>
<p class="instructions">
Finally, if you log out and try again, the malicious site won't be able
to find any resources. This demonstrates that the site was piggybacking
on your prior authentication to steal resources.
</p>
<?
$links = array(
  'attack' => MALROOT."scanning/scan",
);
include(INCDIR.'footer.php');
?>
