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
  return urlencode('<script>'.$code.'</script>');
}

function PrepareImage($src) {
  $src = str_replace('"', '\\"', $src);
  return urlencode('<img src="'.$src.'" />');
}

$attacks = LoadAttacks();

$title = "Malicious server prototype: Reflected XSS";
include(INCDIR.'header.php');
?>
<h1>Reflected XSS</h1>
<p class="instructions">
Clicking on the links below will initiate reflected XSS attacks on the target server.
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
| <a href="<?=TGTROOT?>reflected/target?value=<?=$pl?>"><?=htmlspecialchars($ob)?></a>
<?
  }
}

$links = array(
  'reflected XSS start' => TGTROOT."reflected/start",
);
include(INCDIR.'footer.php');
?>
