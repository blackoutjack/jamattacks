<?php
include('declare.php');

// Enable CORS access
header('Access-Control-Allow-Origin: *');
header('Content-type: text/xml; charset=utf-8');

$doc = new DomDocument('1.0', 'UTF-8');
$resp = $doc->createElement('response');

$from = $doc->createElement('from', $_SERVER['HTTP_HOST']);
$resp->appendChild($from);

$testname = isset($_REQUEST['test']) ? $_REQUEST['test'] : false;
$test = $doc->createElement('test', $testname);
$resp->appendChild($test);

$doc->appendChild($resp);

print $doc->saveXML();
?>
