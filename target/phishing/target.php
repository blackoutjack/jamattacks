<?php
include('../declare.php');

$title = "Attack pattern prototype: Phishing";
include('../inc/header.php');
?>
<h1>Legitimate Page</h1>
<h3>Private session information</h3>
<p class="instructions" id="session">Session id: <?=session_id()?></p>
<?
$links = array(
  'phishing start' => TGTHOST."phishing/start",
);
include('../inc/footer.php');
?>
