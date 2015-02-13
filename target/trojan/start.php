<?php
include('../declare.php');

$title = "Attack pattern prototype: Trojan";
include('../inc/header.php');
?>
<h1>Trojan</h1>
<p class="instructions">
By clicking on the ``attack'' link below, you will taken to another page
on this website that utilizes a script from a malicious site.
</p>
<?
$links = array(
  'attack' => TGTHOST."trojan/attack",
);
include('../inc/footer.php');
?>
