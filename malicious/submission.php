<?php
include('../declare.php');

// Enable CORS access
header('Access-Control-Allow-Origin: *');

$testname = isset($_REQUEST['test']) ? $_REQUEST['test'] : false;
?>
<?xml version="1.0" encoding="UTF-8"?>
<response>
<from><?=htmlspecialchars($_SERVER['HTTP_HOST'])?></from>
<test><?=htmlspecialchars($testname)?></test>
</response>
