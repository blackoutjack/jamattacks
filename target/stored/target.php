<?php
include('../declare.php');

$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : false;
if ($value) {
  $valuedb = mysql_real_escape_string($value);
  $sessiondb = mysql_real_escape_string(session_id());
  mysql_query("INSERT INTO stored (session, value) VALUES ('$sessiondb', '$valuedb');");
}

$title = "Attack pattern prototypes: Stored XSS";
include('../inc/header.php');
?>
<h1>Stored XSS target page</h1>
<h3>Private session information</h3>
<p class="instructions" id="session">
Session id: <?=session_id()?>
</p>
<p class="instructions">
<?
if ($value) {
?>
  The value you submitted has been stored.
<?
} else {
?>
  No value was submitted.
<?
}
?>
You can go here to view previously submitted values: <a href="<?=TGTROOT?>/stored/view">view</a>
</p>
<?
$links = array(
  'stored XSS start' => TGTROOT."stored/start",
);
include('../inc/footer.php');
?>
