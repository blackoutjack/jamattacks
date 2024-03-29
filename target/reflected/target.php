<?php
include('../declare.php');
header('x-xss-protection: 0');

$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';

$title = "Attack pattern prototype: Reflected XSS";
include(INCDIR.'header.php');
?>
<h1>Reflected XSS target page</h1>
<h3>Private session information</h3>
<p class="instructions" id="session">Session id: <?=session_id()?></p>
<form action="">
<input type="text" name="value" value="Input value here"></input>
<input type="submit" value="Submit"></input>
</form>
<p class="instructions" id="value">Received value (escaped): <?=htmlspecialchars($value)?></p>
<p class="instructions" id="value">Received value (raw): <?=$value?></p>
<?
$links = array(
  'reflected XSS start' => TGTROOT.'reflected/start',
  'view' => TGTROOT.'stored/view',
);
include(INCDIR.'footer.php');
?>
