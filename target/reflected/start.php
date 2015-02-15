<?php
include('../declare.php');

$title = "Attack pattern prototype: Reflected XSS";
include('../inc/header.php');
?>
<h1>Reflected XSS</h1>
<p class="instructions">
By clicking on the ``attack'' link below, you will taken to a malicious
website that links back to a page on this domain that contains a
reflected XSS attack. The ``clean'' link will display the same page
sans attack.
</p>
<?
$links = array(
  'attack' => MALROOT."reflected/reflect",
  'clean' => TGTROOT."reflected/target",
);
include('../inc/footer.php');
?>
