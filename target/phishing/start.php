<?php
include('../declare.php');

$title = "Attack pattern prototype: Phishing";
include('../inc/header.php');
?>
<h1>Phishing</h1>
<p class="instructions">
By clicking on the ``attack'' link below, you will taken to a malicious
website that mimics a submission form on this website.
XSS attack. The ``real'' link displays the true submission form.
</p>
<?
$links = array(
  'attack' => MALROOT."phishing/phish",
  'real' => TGTROOT."phishing/target",
);
include('../inc/footer.php');
?>
