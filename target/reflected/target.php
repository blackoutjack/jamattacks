<?php
include('../declare.php');

$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';

$title = "Attack pattern prototype: Reflected XSS";
include('../inc/header.php');
?>
<h1>Reflected XSS target page</h1>
<h3>Private session information</h3>
<p class="instructions" id="session">Session id: <?=session_id()?></p>
<p class="instructions" id="value">Received value: <?=$value?></p>
<?
$links = array(
  'reflected XSS start' => TGTROOT."reflected/start",
  'view' => TGTROOT."stored/view",
);
include('../inc/footer.php');
?>
