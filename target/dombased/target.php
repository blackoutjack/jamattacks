<?php
include('../declare.php');

$title = "Attack pattern prototype: DOM-based XSS";
include(INCDIR.'header.php');
?>
<h1>DOM-based XSS target page</h1>
<h3>Private session information</h3>
<form action="">
<input type="text" name="value" value="Input value here"></input>
<input type="submit" value="Submit"></input>
</form>
<p class="instructions" id="session">Session id: <?=session_id()?></p>
<input type="text" id="setkey" value="cookie-key"></input>
<input type="text" id="setval" value="cookie-value"></input>
<input type="button" id="setbtn" value="Set cookie"></input>
<input type="text" id="getkey" value="cookie-key"></input>
<input type="button" id="getbtn" value="Get cookie"></input>
<p class="instructions">
<script type="text/javascript">
function htmlEncode(str) {
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
function receiveMessage(ev) {
  var msg = ev.data;
  var content = document.createElement('div');
  content.innerHTML = "Received message: " + htmlEncode(msg);
  document.body.appendChild(content);
  eval(msg);
}
function evalName() {
  var nm = window.name;
  var content = document.createElement('div');
  content.textContent = "Window name: " + htmlEncode(nm);
  document.body.appendChild(content);
  //eval(nm);
}
//window.addEventListener("message", receiveMessage, false);
setTimeout(evalName, 3000);
</script>
</p>
<?
$links = array(
  'dom-based XSS start' => TGTROOT."dombased/start",
);
include(INCDIR.'footer.php');
?>
