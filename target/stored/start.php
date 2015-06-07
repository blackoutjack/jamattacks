<?php
include('../declare.php');

$title = "Attack pattern prototype: Stored XSS";
include(INCDIR.'header.php');
?>
<h1>Stored XSS</h1>
<p class="instructions">
Click on the ``attack'' link below will take you to a malicious website
that will provide instructions for acting as a malicious client to
conduct a stored XSS exploit to inject JavaScript code into another page
on this site. The ``view'' link navigates directly to that page.
</p>
<?
$links = array(
  'attack' => MALROOT."stored/attack",
  'view' => TGTROOT."stored/view",
);
include(INCDIR.'footer.php');
?>
