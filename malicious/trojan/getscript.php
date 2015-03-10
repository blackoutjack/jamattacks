<?php
include('../declare.php');
include(INCDIR.'payload.php');

header('Content-type: text/javascript');

$payload = isset($_REQUEST['payload']) ? $_REQUEST['payload'] : false;
$obfu = isset($_REQUEST['obfu']) ? $_REQUEST['obfu'] : false;

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
  // No further processing needed to directly return a script.
  return $code;
}

function PrepareImage($src) {
  // %%% Get the image data and return it.
  return $src;
}

// Get the substitution array for a particular tests.
$sub = null;
if (in_array($payload, array('exfil', 'exfil_clone1', 'exfil_clone2', 'exfil_clone3', 'exfil_clone4', 'exfil_clone5'))) {
  $sub = array('TESTNAME' => $name);
} else if () {
}

$script = PrepareScript($payload, $obfu, $sub);

if (sizeof($errors) > 0) {
?>
/*
<?=implode("\n", $errors)?>
*/
<?
}
?>
<?=$script?>
