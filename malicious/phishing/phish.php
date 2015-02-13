<?php
include('../declare.php');

$title = "Malicious client prototype: Phishing";
include('../inc/header.php');
?>
<h1>Legitimate Page <span class="quiet">(Phishing)</span></h1>
<p class="instructions">
</p>
<?
$links = array(
  'phishing start' => TGTHOST."phishing/start",
);
include('../inc/footer.php');
?>
