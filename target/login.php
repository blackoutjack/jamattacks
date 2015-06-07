<?php
include_once('declare.php');
include_once(INCDIR.'contentutil.php');

$title = "Target Website Login";
$logintitle = "Target Website Login";

include(INCDIR.'header.php');

include(INCDIR.'loginform.php');

$links = array();
$back = LoadParam('referer', $_REQUEST);
if ($back !== null) $links['back'] = $back;
include(INCDIR.'footer.php');
?>
