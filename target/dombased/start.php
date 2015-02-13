<?php
include('../declare.php');

$title = "Attack pattern prototype: DOM-based XSS";
include('../inc/header.php');
?>
<h1>DOM-based XSS</h1>
<p class="instructions">
By clicking on the ``attack'' link below, you will be taken to a
malicious website that embeds a different page on this site to conduct
a DOM-based XSS attack. The ``clean'' link will display the same page
without the embedding attack.
</p>
<?
$links = array(
  'attack' => MALHOST."dombased/embed",
  'clean' => TGTHOST."dombased/target",
);
include('../inc/footer.php');
?>
