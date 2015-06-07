<?php
include('../declare.php');

$errors = array();

$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : false;
$valok = false;
if ($value) {
  if (strlen($value) > 65535) {
    $errors[] = "Submitted value is too long";
  } else {
    $valuedb = mysql_real_escape_string($value);
    $sessiondb = mysql_real_escape_string(session_id());
    $valok = mysql_query("INSERT INTO stored (session, value) VALUES ('$sessiondb', '$valuedb');");
  }
}

$title = "Attack pattern prototypes: Stored XSS";
include(INCDIR.'header.php');
?>
<h1>Stored XSS target page</h1>
<?
if (sizeof($errors) > 0) {
?>
<p id="error"><?=implode('<br/>', array_map('htmlspecialchars', $errors))?></p>
<?
}
?>
<h3>Private session information</h3>
<p class="instructions" id="session">
Session id: <?=session_id()?>
</p>
<p class="instructions">
<?
if ($valok) {
?>
  The value you submitted has been stored.
<?
} else {
?>
  No value was submitted.
<?
}
?>
You can go here to view previously submitted values: <a href="<?=TGTROOT?>stored/view">view</a>
</p>
<?
$links = array(
  'stored XSS start' => TGTROOT."stored/start",
);
include(INCDIR.'footer.php');
?>
