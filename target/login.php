<?php
include "declare.php";

$title = "Target Website Login";
$logintitle = "Target Website Login";
$links = array();
if (isset($_REQUEST['referer'])) {
  $links['back'] = $_REQUEST['referer'];
}

include(INCDIR.'loginform.php');
?>
