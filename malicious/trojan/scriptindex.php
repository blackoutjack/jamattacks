<?php
include('../declare.php');
include(INCDIR.'payload.php');

header('Content-type: text/xml');

$errors = array();

function PrepareScript($testname, $obfu, $subs) {
  return '';
}

function PrepareImage($src) {
  return '';
}

$attacks = LoadAttacks();

echo '<?xml version="1.0" encoding="UTF-8"?>';

if (sizeof($errors) > 0) {
?>
<!--
<?=implode("\n", array_map('htmlspecialchars', $errors))?>
-->
<?
}

?>
<payloads>
<?

foreach ($attacks as $aname => $attack) {
?>
  <attack name="<?=htmlspecialchars($aname)?>">
<?
  foreach ($attack as $ob => $pl) {
    if (strpos($ob, '#') === 0) {
      $tag = htmlspecialchars(substr($ob, 1));
?>
    <<?=$tag?>><?=htmlspecialchars($pl)?></<?=$tag?>>
<?
    } else {
      $url = htmlspecialchars(MALROOT.'trojan/getscript.php?payload='.urlencode($aname).'&obfu='.urlencode($ob));
?>
    <obfuscation name="<?=htmlspecialchars($ob)?>" url="<?=$url?>" />
<?
    }
  }
?>
  </attack>
<?
}
?>
</payloads>
