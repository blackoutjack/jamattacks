<?php
include('../declare.php');

$title = "Attack pattern prototype: Phishing";
$logintitle = "Target website login";
$links = array(
  'phishing start' => TGTHOST."phishing/start",
);

include(INCDIR.'loginform.php');
?>
