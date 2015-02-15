<?php
include('../declare.php');

$title = "Attack pattern prototype: DOM-based XSS";
include('../inc/header.php');
?>
<h1>DOM-based XSS target page</h1>
<h3>Private session information</h3>
<p class="instructions" id="session">Session id: <?=session_id()?></p>
<p class="instructions">
<script type="text/javascript">
var name = window.name;
document.write("window.name: " + name);
</script>
</p>
<?
$links = array(
  'dom-based XSS start' => TGTROOT."dombased/start",
);
include('../inc/footer.php');
?>
